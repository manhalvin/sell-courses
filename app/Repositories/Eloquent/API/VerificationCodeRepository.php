<?php
namespace App\Repositories\Eloquent\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\VerificationCode;
use App\Interfaces\API\Repositories\VerificationCodeRepositoryInterface;

class VerificationCodeRepository implements VerificationCodeRepositoryInterface
{
    protected $verificationCode;

    public function __construct()
    {
        $this->verificationCode = new VerificationCode;
    }

    /**
     * Lấy thông tin bảng Verification Code thông qua user id
     * @return \Illuminate\Database\Eloquent\Collection|array<\Illuminate\Database\Eloquent\Model>
     */
    public function getVerificationCodeByUserId($userId)
    {
        return $this->verificationCode->where('user_id', $userId)->latest()->first();
    }

    /**
     * Kiểm tra mã OTP tồn tại bởi user id
     * @param mixed $userId
     * @param mixed $otp
     * @return mixed
     */
    public function checkOtpExist($userId, $otp)
    {
        return $this->verificationCode->where('user_id', $userId)
            ->where('otp', $otp)->first();
    }

    /**
     * Tạo mã OTP bởi user id
     * @param mixed $userId
     * @return mixed
     */
    public function createOtpByUserId($userId, $email)
    {
        return $this->verificationCode->create([
            'user_id' => $userId,
            'otp' => rand(123456, 999999),
            'email' => $email,
            'expire_at' =>  Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(10),
        ]);
    }

    /**
     * Cập nhật thời gian hiệu lực mã OTP
     * @return bool
     */
    public function  updateExpireAt()
    {
        return $this->verificationCode->update([
            'expire_at' => Carbon::now()
        ]);
    }

}
