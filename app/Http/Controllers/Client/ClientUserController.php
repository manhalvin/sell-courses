<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Services\API\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\API\Client\ProfileRequest;

class ClientUserController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserService;
    }

    /**
     * Cập nhật thông tin cá nhân
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(ProfileRequest $request)
    {
        $userId = Auth::user()->id;
        $data = $request->all();
        $data['password'] = bcrypt($request->input('password'));
        $data['user_updated'] = Auth::user()->name;
        $hasFile = $request->hasFile('thumbnail');
        $thumbnail = $request->thumbnail;

        try {
            $this->model->handleUpdateUser($data, $userId, $hasFile, $thumbnail);
            return $this->sendResponse([], 'Update Data User Success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Hiển thị thông tin chi tiết của user đang đăng nhập
     * @return \Illuminate\Http\JsonResponse
     */
    public function infoProfile()
    {
        $userId = Auth::user()->id;
        try {
            $result = $this->model->getById($userId);
            return $this->sendResponse($result, 'Success ! Fetch user success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }
}
