<?php

namespace App\Interfaces\API\Repositories;


interface VerificationCodeRepositoryInterface
{
    public function getVerificationCodeByUserId($userId);
    public function createOtpByUserId($userId, $email);
    public function checkOtpExist($userId, $otp);
    public function updateExpireAt();
}
