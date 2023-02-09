<?php

namespace App\Interfaces\API\Services;

interface AuthServiceInterface
{
    public function handleRegister($inputData, $userData, $thumbnail);

    public function handleVerifyAccount(string $uuid);

    public function handleVerifyWithOtp($userId, $otp);

    public function verifyEmail($email);

    public function handleLogin($password, $userData, $ip, $user);

    public function handleChangePassword($passwordOld, $passwordNew, $password, $uuid);

    public function handleForgotPassword($inputData);

    public function handleForgotPasswordWithOtp($inputData);

}
