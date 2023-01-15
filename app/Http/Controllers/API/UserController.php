<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\API\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\UserRequest;
use App\Http\Requests\API\UpdateUserRequest;

class UserController extends BaseController
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    /**
     * Hiển thị danh sách người dùng
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $search = "";
        $status = $request->input('status');
        $roleId = $request->input('role_id');

        if (!empty($request->search)) {
            $search = $request->search;
        }
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');

        try {
            $userList = $this->userService->getUserList($status, $roleId, $search, $sortBy, $sortType);
            return $this->sendResponse($userList, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Thêm người dùng
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->input('password'));
        $data['user_created'] = Auth::user()->name;
        $hasFile = $request->hasFile('thumbnail');
        $thumbnail = $request->thumbnail;

        try {
            $result = $this->userService->handleSaveUserData($data, $thumbnail, $hasFile);
            return $this->sendResponse($result, 'Success ! Create data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Xem thông tin chi tiết user
     * @param int $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($user)
    {
        try {
            $result = $this->userService->getById($user);
            return $this->sendResponse($result, 'Success ! Fetch user success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Cập nhật thông tin người dùng
     * @param UpdateUserRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, $id){
        $data = $request->all();
        $data['password'] = bcrypt($request->input('password'));
        $data['user_updated'] = Auth::user()->name;
        $hasFile = $request->hasFile('thumbnail');
        $thumbnail = $request->thumbnail;

        try {
            $this->userService->handleUpdateUser($data, $id, $hasFile, $thumbnail);
            return $this->sendResponse([], 'Update Data User Success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Xóa mềm người dùng
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->userService->handleDeleteUser($id);
            return $this->sendResponse([], 'Delete Data User Success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Thực hiện các hành động như: xóa tạm thời, xóa vĩnh viễn
     * khôi phục hàng loạt bản ghi
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function action(Request $request)
    {
        $listCheck = $request->input('list_check');
        $action = $request->input('action');

        try {
            $result = $this->userService->handleUserAction($listCheck, $action);
            return $this->sendResponse([], $result);
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

}
