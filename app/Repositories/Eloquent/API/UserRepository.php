<?php
namespace App\Repositories\Eloquent\API;

use App\Http\Requests\API\UpdateUserRequest;
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

    public function updateUser($userId, UpdateUserRequest $updateUserRequest)
    {
        $user = $this->user->find($userId);
        if ($user) {
            $user->update($updateUserRequest->toArray());
        }
    }

    public function deleteUser($userId)
    {
        $this->user->destroy($userId);
    }
}
