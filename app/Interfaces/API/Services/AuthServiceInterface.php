<?php

namespace App\Interfaces\API\Services;

interface AuthServiceInterface
{
    public function handleRegister($inputData, $userData, $hasFile, $thumbnail);

    public function handleVerifyAccount(string $uuid);

    public function handleVerifyWithOtp($userId, $otp);

}
