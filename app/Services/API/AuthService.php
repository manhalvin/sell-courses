<?php
namespace App\Services\API;

use App\Interfaces\API\Repositories\UserRepositoryInterface;
use App\Interfaces\API\Repositories\VerificationCodeRepositoryInterface;
use App\Interfaces\API\Services\AuthServiceInterface;
use App\Mail\API\ForgotPasswordMail;
use App\Mail\API\RegisterMail;
use App\Repositories\Eloquent\API\FailedLoginRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Avatar;

class AuthService extends BaseService implements AuthServiceInterface
{
    private $userRepository;
    private $verificationCodeRepository;
    private $failedLoginRepository;

    public function __construct(UserRepositoryInterface $userRepository,
        VerificationCodeRepositoryInterface $verificationCodeRepository) {
        $this->userRepository = $userRepository;
        $this->verificationCodeRepository = $verificationCodeRepository;
        $this->failedLoginRepository = new FailedLoginRepository;
    }

    /**
     * Xử lý chức năng đăng ký tài khoản
     * @param mixed $inputData
     * @param mixed $userData
     * @param mixed $hasFile
     * @param mixed $thumbnail
     * @return array
     */
    public function handleRegister($inputData, $userData, $thumbnail)
    {
        $userData['uuid'] = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
        $userData['password'] = bcrypt($inputData['password']);

        if (!$thumbnail) {
            $avatar = new Avatar();
            $userData['thumbnail'] = $avatar->create($inputData['name'])->toBase64();
        } else {
            $extension = $thumbnail->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $userData['thumbnail'] = 'image/users/' . $imageName;
            Storage::put('image/users/' . $imageName, file_get_contents($thumbnail));
        }

        $userId = $this->userRepository->createUser($userData);
        if (!$userId) {
            $this->sendError("Sorry ! Unable to create an account !");
        }

        # Generate An OTP
        $verificationCode = $this->generateOtp($userData['email']);
        if (!$verificationCode) {
            $this->sendError("Unable to generate an OTP");
        }

        $message = "Your OTP is - " . $verificationCode->otp;

        $userData = [
            'name' => $inputData['username'],
            'email' => $inputData['email'],
            'uuid' => $userData['uuid'],
            'message' => $message,
        ];

        Mail::to($inputData['email'])->send(new RegisterMail($userData));

        return [
            'uuid' => $userData['uuid'],
            'otp' => $verificationCode->otp,
            'user_id' => $userId,
        ];

    }

    /**
     * Tạo mã OTP
     * @param mixed $email
     * @return mixed
     */
    public function generateOtp($email)
    {
        $checkEmailExist = $this->userRepository->checkEmailExist($email);
        if (!$checkEmailExist) {
            $this->sendError("Not find email !");
        }
        $user = $this->userRepository->getUserByEmail($email);

        # User Does not Have Any Existing OTP
        $verificationCode = $this->verificationCodeRepository->getVerificationCodeByUserId($user->id);

        $now = Carbon::now('Asia/Ho_Chi_Minh');

        if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
            return $verificationCode;
        }

        // Create a New OTP
        $result = $this->verificationCodeRepository->createOtpByUserId($user->id, $user->email);
        return $result;
    }

    /**
     *  Xử lý chức năng đăng ký xác thực tài khoản qua uuid
     * @param mixed $uuid
     * @return mixed
     */
    public function handleVerifyAccount($uuid)
    {
        $checkUuidExist = $this->userRepository->checkUuidExist($uuid);
        if (!$checkUuidExist) {
            $this->sendError("Unable to request !");
        }

        $userData = $this->userRepository->getUserByUuid($uuid);
        if (!$userData) {
            $this->sendError("We are unable to find your account !");
        }

        if (!$this->verifyExpireTime($userData->activation_date)) {
            $userData->delete();
            $this->sendError("Activation link was expired !");
        }

        if ($userData->status == 1) {
            $this->sendError("Account has been activated ! ");
        }

        $result = $this->userRepository->updateUserStatusByUuid($uuid);
        if (!$result) {
            $this->sendError("Account activated failed !");
        }
        return $result;
    }

    /**
     * Kiểm tra link xác thực email đã hết hiệu lực chưa ?
     * @param mixed $regulateTime
     * @return bool
     */
    public function verifyExpireTime($regulateTime)
    {
        $currentTime = strtotime(now());
        $regulateTime = strtotime($regulateTime);
        $differenceTime = $currentTime - $regulateTime;

        if ($differenceTime < 3600) {
            return true;
        }

        return false;
    }

    // Xư lý xác thực OTP
    public function handleVerifyWithOtp($userId, $otp)
    {
        # Validation Logic
        $verificationCode = $this->verificationCodeRepository->checkOtpExist($userId, $otp);

        $now = Carbon::now("Asia/Ho_Chi_Minh");
        if (!$verificationCode) {
            $this->sendError("Your OTP is not correct");
        } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
            $this->sendError("Your OTP has been expired");
        }

        $user = $this->userRepository->whereId($userId);

        if (!$user) {
            // Expire The OTP
            $this->sendError("Your OTP is not correct");
        }
        $this->verificationCodeRepository->updateExpireAt();
        $result = $this->userRepository->updateUserStatusById($userId);
        return $result;

    }

    /**
     * Xác thực email của người dùng
     * @param mixed $email
     * @return mixed
     */
    public function verifyEmail($email)
    {
        $userData = $this->userRepository->getUserByEmail($email);
        if (!$userData) {
            $this->sendError("Unauthorize !");
        }
        return $userData;
    }

    /**
     * Xử lý chức năng login
     * @param mixed $password
     * @param mixed $userData
     * @return array<string>
     */
    public function handleLogin($password, $userData, $ip, $user)
    {
        $data = [
            'email' => $userData->email,
            'password' => $password,
        ];

        // activity()->log('Look mum, I logged something');
        $failedLogin = $this->failedLoginRepository->getById();
        $now = Carbon::now();

        if ($failedLogin) {
            if ($failedLogin->attempts >= 2) {

                if(!$failedLogin->time){
                    $failedLogin->time = Carbon::now()->addMinutes(1);
                }else{

                    // if(!$now->isAfter($failedLogin->time)){
                    //     $this->sendError("IP address has been banned for 1 minutes");
                    // }

                    $currentTime = strtotime($now);
                    $regulateTime = strtotime($failedLogin->time);
                    $differenceTime = $currentTime - $regulateTime;

                    if ($differenceTime <= 0) {
                        $this->sendError("IP address has been banned for 1 minutes");
                    }

                    $this->failedLoginRepository->update($ip);
                }

                $failedLogin->save();
            }

        }

        if (!Auth::attempt($data)) {
            $this->failedLoginRepository->saveFailedLogin($ip);
            $this->sendError("Unauthorize !");
        }

        if (!$userData->status) {
            $this->sendError("Please activate your account ! Contact admin !");
        }

        $result = [
            'token' => $user->createToken('token')->plainTextToken,
        ];
        return $result;
    }

    /**
     * Xử lý chức năng thay đổi mật khẩu
     * @param mixed $passwordOld
     * @param mixed $passwordNew
     * @param mixed $password
     * @param mixed $uuid
     * @return mixed
     */
    public function handleChangePassword($passwordOld, $passwordNew, $password, $uuid)
    {
        if (!password_verify($passwordOld, $password)) {
            $this->sendError('Password old does not matched with database password');
        }

        $result = $this->userRepository->updatePassword($passwordNew, $uuid);
        if (!$result) {
            $this->sendError('Update password fail !');
        }
        return $result;
    }

    /**
     * Xử lý chức năng quên mật khẩu
     * @param mixed $inputData
     * @return array
     */
    public function handleForgotPassword($inputData)
    {
        $user = $this->userRepository->getUserByEmail($inputData['email']);
        if (!$user) {
            $this->sendError('Error ! Email not exist !');
        }

        # Tạo mã OTP
        $verificationCode = $this->generateOtp($inputData['email']);
        $data = [
            'name' => $user->username,
            'message' => "Your OTP : " . $verificationCode->otp,
        ];

        Mail::to($inputData['email'])->send(new ForgotPasswordMail($data));
        return [
            'otp' => $verificationCode->otp,
            'user_id' => $user->id,
        ];
    }

    /**
     * Xử lý Chức năng nhập OTP + nhập password mới
     * dùng trong chức năng quên mật khẩu
     * @param mixed $inputData
     * @return mixed
     */
    public function handleForgotPasswordWithOtp($inputData)
    {
        $verificationCode = $this->verificationCodeRepository
            ->checkOtpExist($inputData['user_id'], $inputData['otp']);

        $now = Carbon::now();
        if (!$verificationCode) {
            $this->sendError('Error ! OTP is not correct !');
        } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
            $this->sendError('Error ! OTP has been expired !');
        }

        $user = $this->userRepository->whereId($inputData['user_id']);
        if (!$user) {
            $this->sendError('"Error ! No find User !');
        }

        $password = Hash::make($inputData['password']);
        $result = $this->userRepository->updatePassword($password, $user->uuid);
        if (!$result) {
            $this->sendError('Error ! Update password fail !');
        }
        return $result;
    }

}
