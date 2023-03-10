<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Enums\Role;
use App\Enums\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\VerifyCodeRequest;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Requests\API\Auth\ChangePasswordRequest;
use App\Http\Requests\API\Auth\ForgotPasswordRequest;
use App\Interfaces\API\Services\AuthServiceInterface;
use App\Http\Requests\API\Auth\ForgotPasswordWithOtpRequest;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Đăng ký tài khoản
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $inputData = $request->all();

        $userData = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'status' => Status::Inactive,
            'mobile_no' => $request->input('phone'),
            'role_id' => Role::User,
            'activation_date' => now(),
        ];
        $thumbnail = $request->thumbnail;

        try {
            $result = $this->authService->handleRegister($inputData, $userData, $thumbnail);
            return $this->sendResponse($result, 'Send mail success !', 200);
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null, 400);
        }
    }

    /**
     * Người dùng nhấn link xác thực đăng ký tài khoản
     * @param string $uuid
     * @return mixed
     */
    public function verifyAccount($uuid)
    {
        try {
            $this->authService->handleVerifyAccount($uuid);
            return $this->sendResponse([], 'Account verification successful !', 200);
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null, 400);
        }
    }

    /**
     * Xác thực OTP
     * @param mixed $userId
     * @param VerifyCodeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyWithOtp($userId, VerifyCodeRequest $request)
    {
        $otp = $request->otp;
        $userId = $request->user_id;
        try {
            $this->authService->handleVerifyWithOtp($userId, $otp);
            return $this->sendResponse([], 'Verification OTP successful !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Chức năng đăng nhập tài khoản
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $ip = $request->ip();
        $user = Auth::user();


        try {
            $userData = $this->authService->verifyEmail($email);
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }

        try {
            $result = $this->authService->handleLogin($password, $userData, $ip, $user);
            return $this->sendResponse($result, 'Login successful !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Chức năng: Thay đổi mật khẩu
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $passwordOld = $request->input('password_old');
        $passwordNew = Hash::make($request->input('password_new'));
        $password = Auth::user()->password;
        $uuid = Auth::user()->uuid;

        try {
            $this->authService->handleChangePassword($passwordOld, $passwordNew, $password, $uuid);
            return $this->sendResponse([], 'Change password success');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Chức năng quên mật khẩu
     * @param ForgotPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $inputData = $request->all();
        $inputData['uuid'] = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));

        try {
            $result = $this->authService->handleForgotPassword($inputData);
            return $this->sendResponse($result, 'Success ! You have a new OTP in your email ! ');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Chức năng nhập OTP + nhập password mới
     * dùng trong chức năng quên mật khẩu
     * @param ForgotPasswordWithOtpRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function forgotPasswordWithOtp(ForgotPasswordWithOtpRequest $request)
    {
        $inputData = $request->all();

        try {
            $this->authService->handleForgotPasswordWithOtp($inputData);
            return $this->sendResponse([], 'Success ! Update password success ');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    // Chức năng logout
    public function logout()
    {
        Auth::logout();
        Session::forget('_token');
        return $this->sendResponse([], 'Success ! Logout success ');
    }

}
