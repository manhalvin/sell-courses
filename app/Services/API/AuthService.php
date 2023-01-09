<?php
namespace App\Services\API;

use App\Interfaces\API\Repositories\UserRepositoryInterface;
use App\Interfaces\API\Repositories\VerificationCodeRepositoryInterface;
use App\Interfaces\API\Services\AuthServiceInterface;
use App\Mail\API\RegisterMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravolt\Avatar\Avatar;

class AuthService extends BaseService implements AuthServiceInterface
{
    private $userRepository;
    private $verificationCodeRepository;

    public function __construct(UserRepositoryInterface $userRepository,
        VerificationCodeRepositoryInterface $verificationCodeRepository) {
        $this->userRepository = $userRepository;
        $this->verificationCodeRepository = $verificationCodeRepository;
    }

    /**
     * Xử lý chức năng đăng ký tài khoản
     * @param mixed $inputData
     * @param mixed $userData
     * @param mixed $hasFile
     * @param mixed $thumbnail
     * @return array
     */
    public function handleRegister($inputData, $userData, $hasFile, $thumbnail)
    {
        if (!$hasFile) {
            $avatar = new Avatar();
            $userData['thumbnail'] = $avatar->create($inputData['name'])->toBase64();
        } else {
            $imageName = $thumbnail->getClientOriginalName();
            $thumbnail->move('image/users', $imageName);
            $image = 'image/users/' . $imageName;
            $userData['thumbnail'] = $image;
        }

        $userId = $this->userRepository->createUser($userData);
        if (!$userId) {
            $this->sendError("Sorry ! Unable to create an account !");
        }

        # Generate An OTP
        $verificationCode = $this->generateOtp($userData['email']);
        if ($verificationCode) {
            $message = "Your OTP is - " . $verificationCode->otp;

            $data = [
                'name' => $inputData['username'],
                'email' => $inputData['email'],
                'uuid' => $inputData['uuid'],
                'message' => $message,
            ];

            Mail::to($inputData['email'])->send(new RegisterMail($data));
            return [
                'uuid' => $inputData['uuid'],
                'otp' => $verificationCode->otp,
                'user_id' => $userId,
            ];
        }

    }

    public function generateOtp($email)
    {
        $checkEmailExist = $this->userRepository->checkEmailExist($email);
        if (!$checkEmailExist) {
            $this->sendError("Sorry ! Not find email !");
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
            $this->sendError("Sorry ! Unable to request !");
        }

        $userData = $this->userRepository->getUserByUuid($uuid);
        if (!$userData) {
            $this->sendError("Sorry ! We are unable to find your account !");
        }

        if (!$this->verifyExpireTime($userData->activation_date)) {
            $this->sendError("Sorry ! Activation link was expired !");
        }

        if ($userData->status == 1) {
            $this->sendError("Sorry ! Account has been activated ! ");
        }

        $result = $this->userRepository->updateUserStatusByUuid($uuid);
        if (!$result) {
            $this->sendError("Sorry ! Account activated failed !");
        }
        return $result;
    }

    /**
     * Link xác thực tài khoản thời gian hết hạn
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
    }

    // Xư lý xác thực OTP
    public function handleVerifyWithOtp($userId, $otp)
    {
        # Validation Logic
        $verificationCode = $this->verificationCodeRepository->checkOtpExist($userId, $otp);

        $now = Carbon::now("Asia/Ho_Chi_Minh");
        if (!$verificationCode) {
            $this->sendError("Sorry ! Your OTP is not correct");
        } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
            $this->sendError("Sorry ! Your OTP has been expired");
        }

        $user = $this->userRepository->whereId($userId);

        if (!$user) {
            // Expire The OTP
            $this->sendError("Sorry ! Your OTP is not correct");
        }
        $this->verificationCodeRepository->updateExpireAt();
        $result = $this->userRepository->updateUserStatusById($userId);
        return $result;

    }

    public function verifyEmail($email)
    {
        $userData = $this->userRepository->getUserByEmail($email);
        if (!$userData) {
            $this->sendError("Sorry ! Unauthorize !");
        }
        return $userData;
    }

    public function handleLogin($password, $userData)
    {
        $data = [
            'email' => $userData->email,
            'password' => $password,
        ];

        if (!Auth::attempt($data)) {
            $this->sendError("Sorry ! Unauthorize !");
        }

        if ($userData->status == 0) {
            $this->sendError("Please activate your account ! Contact admin !");
        }

        $user = Auth::user();
        $success = [
            'token' => $user->createToken('token')->plainTextToken,
        ];
        return $success;
    }

    public function handleChangePassword($passwordOld, $passwordNew, $password, $uuid)
    {
        if (!password_verify($passwordOld, $password)) {
            $this->sendError('Password old does not matched with database password');
        }

        $result = $this->userRepository->updatePassword($passwordNew, $uuid);
        if (!$result) {
            $this->sendError('Error ! Update password fail !');
        }
        return $result;
    }

}
