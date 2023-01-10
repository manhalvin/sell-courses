<?php
namespace App\Repositories\Eloquent\API;

use App\Interfaces\API\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct()
    {
        $this->user = new User;
    }

    /**
     * Lấy tất cả danh sách người dùng
     * @return \Illuminate\Database\Eloquent\Collection|array<\Illuminate\Database\Eloquent\Model>
     */
    public function getUserAll()
    {
        return $this->user->all();
    }

    /**
     * Lấy thông tin người dùng theo uuid
     * @param string $uuid
     * @return mixed
     */
    public function getUserByUuid($uuid)
    {
        $result = $this->user->select('activation_date', 'uuid', 'status')
            ->where('uuid', $uuid)
            ->first();
        return $result;
    }

    /**
     * Lấy thông tin người dùng theo id
     * @param mixed $userId
     * @return mixed
     */
    public function getUserById($userId)
    {
        return $this->user->findOrFail($userId);
    }

    /**
     * Kiểm tra uuid user tồn tại
     * @param string $uuid
     * @return mixed
     */
    public function checkUuidExist(string $uuid)
    {
        return $this->user->where('uuid', $uuid)->exists();
    }

    /**
     * Kiểm tra email đã tồn tại trong database
     * @param string $email
     * @return mixed
     */
    public function checkEmailExist(string $email)
    {
        return $this->user->where('email', $email)->exists();
    }

    public function getUserByEmail($email)
    {
        $result = $this->user
            ->where('email', $email)
            ->first();
        return $result;
    }

    /**
     * Cập nhật trạng thái người dùng qua uuid
     * @param string $uuid
     * @return mixed
     */
    public function updateUserStatusByUuid(string $uuid)
    {
        $result = $this->user
            ->where('uuid', $uuid)
            ->update(['status' => 1]);
        return $result;
    }

    public function updateUserStatusById($id)
    {
        $result = $this->user
            ->where('id', $id)
            ->update(['status' => 1]);
        return $result;
    }

    /**
     * Thêm mới người dùng/ thêm tài khoản
     * @param mixed $userData
     * @return mixed
     */
    public function createUser($userData)
    {
        return $this->user->create($userData)->id;
    }

    public function whereId($userId)
    {
        return $this->user->whereId($userId)->first();
    }

    /**
     * Thay đổi mật khẩu qua uuid của user
     * @param mixed $passwordNew
     * @param mixed $uuid
     * @return mixed
     */
    public function updatePassword($passwordNew, $uuid)
    {
        return $this->user->where('uuid', $uuid)
            ->update(['password' => $passwordNew]);
    }

    public function getUserList($status, $filters = [], $search = null, $sortArr = null, $perPage = null)
    {
        $users = $this->user
        ->select('users.*', 'roles.name as role_name')
        ->join('roles', 'users.role_id', '=', 'roles.id');

        $orderBy = 'users.created_at';
        $orderType = 'desc';

        if (!empty($sortArr) && is_array($sortArr)) {
            if (!empty($sortArr['sortBy']) && !empty($sortArr['sortType'])) {
                $orderBy = trim($sortArr['sortBy']);
                $orderType = trim($sortArr['sortType']);
            }
        }

        if (!empty($filters)) {
            $users = $users->where($filters);
            // $users->whereNotNull('users.deleted_at');
        }

        if (!empty($search)) {
            $users = $users->where(function ($query) use ($search) {
                $query->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('users.username', 'like', "%{$search}%");
            });
        }

        return !empty($perPage)
        ? $users->orderBy($orderBy, $orderType)->paginate($perPage)
        : $users->orderBy($orderBy, $orderType)->get();

    }

    public function updateUser($data, $user)
    {
        return $user = $this->user->find($user)
            ->update($data);
    }

    /**
     * Xóa tạm thời user vào db
     * @param mixed $user
     * @return mixed
     */
    public function deleteUser($user)
    {
        return $user = $this->user->find($user)
            ->delete();
    }

    public function userDestroy($listCheck)
    {
        return $this->user->destroy($listCheck);
    }

    public function userRestoreTrashed($listCheck)
    {
        return $this->user->withTrashed()->whereIn('id', $listCheck)->restore();
    }

    /**
     *  Xóa vĩnh viễn user
     * @param mixed $listCheck
     * @return mixed
     */
    public function userForceDelete($listCheck)
    {
        return $this->user->withTrashed()->whereIn('id', $listCheck)->forceDelete();
    }

}
