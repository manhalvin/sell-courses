<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Services\API\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\API\Client\ProfileRequest;

class UserController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserService;
    }

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
