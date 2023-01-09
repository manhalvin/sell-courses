<?php

namespace App\Interfaces\API\Services;

interface AuthServiceInterface
{
    public function handleRegister($inputData, $userData, $hasFile, $thumbnail);

    public function handleVerifyAccount(string $uuid);

    public function handleVerifyWithOtp($userId, $otp);

    public function verifyEmail($email);

    public function handleLogin($password, $userData);

    public function handleChangePassword($passwordOld, $passwordNew, $password, $uuid);

}
