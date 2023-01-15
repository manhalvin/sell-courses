<?php
namespace App\Services\API;

use App\Http\Resources\API\UserResource;
use App\Repositories\Eloquent\API\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laravolt\Avatar\Avatar;

class UserService extends BaseService
{
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    /**
     * Xử lý lấy danh sách người dùng
     * combo: status + filter: role + search + sort
     * @param mixed $status
     * @param mixed $roleId
     * @param mixed $search
     * @param mixed $sortBy
     * @param mixed $sortType
     * @throws \Exception
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUserList($status, $roleId, $search, $sortBy, $sortType)
    {
        // Lọc trạng thái tài khoản
        $filters = [];
        if (!empty($status)) {
            if ($status == 'active') {
                $status = 1;
            } elseif ($status == 'unactive') {
                $status = 0;
            }
            $filters[] = ['users.status', '=', $status];
        }

        // Lọc vai trò
        if (!empty($roleId)) {
            $filters[] = ['users.role_id', '=', $roleId];
        }

        // Sắp xếp các cột theo thứ tự desc,asc
        $allowSort = ['asc', 'desc'];
        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            if ($sortType == 'desc') {
                $sortType = 'asc';
            } else {
                $sortType = 'desc';
            }
        } else {
            $sortType = 'asc';
        }
        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType,
        ];

        $result = $this->userRepository->getUserList($status, $filters, $search, $sortArr, config('services.PER_PAGE'));
        if (!$result->count()) {
            throw new \Exception('Error ! Fetch Data User No Success', 1);
        }
        return UserResource::collection($result);
    }

    /**
     * Xử lý thêm người dùng
     * @param mixed $data
     * @param mixed $thumbnail
     * @param mixed $hasFile
     * @throws \Exception
     * @return array
     */
    public function handleSaveUserData($data, $thumbnail, $hasFile)
    {
        if (!$hasFile) {
            $avatar = new Avatar();
            $data['thumbnail'] = $avatar->create($data['name'])->toBase64();
        } else {
            $imageName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('image/users', $imageName);
            $image = 'image/users/' . $imageName;
            $data['thumbnail'] = $image;
        }

        $result = $this->userRepository->createUser($data);
        if (!$result) {
            throw new \Exception('Error ! Create Data User No Success', 1);
        }
        $success = [
            'user_id' => $result,
        ];
        return $success;
    }

    /**
     * Xử lý lấy chi tiết user
     * @param int $id
     * @throws \Exception
     * @return array
     */
    public function getById($id)
    {
        $users = $this->userRepository->getUserAll();
        $dataId = [];
        foreach ($users as $user) {
            $dataId[] = $user->id;
        }

        if (!in_array($id, $dataId)) {
            throw new \Exception('Error ! No find User', 1);
        }

        $result = $this->userRepository->getUserById($id);
        if (!$result) {
            throw new \Exception('Error ! Fetch Data User No Success', 1);
        }

        $success = [
            'user' => new UserResource($result),
        ];

        return $success;
    }

    /**
     * Xử lý cập nhật thông tin user
     * @param array $data
     * @param int $id
     * @throws \Exception
     * @return array<string>
     */
    public function handleUpdateUser($data, $id, $hasFile, $thumbnail)
    {
        $user = $this->userRepository->getUserById($id);
        if (!$user) {
            throw new \Exception('Error ! No find User', 1);
        }

        if ($hasFile) {
            if (File::exists($user->thumbnail)) {
                File::delete($user->thumbnail);
                unlink($user->thumbnail);
            }
            $extension = $thumbnail->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $thumbnail->move('image/users', $imageName);
            $image = 'image/users/' . $imageName;
            $data['thumbnail'] = $image;
        }

        $result = $this->userRepository->updateUser($data, $id);
        if (!$result) {
            throw new \Exception('Error ! Update Data User No Success', 1);
        }

        return $result;
    }

    /**
     * Xử lý xóa mềm bản ghi
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function handleDeleteUser($id)
    {
        $users = $this->userRepository->getUserAll();

        $dataId = [];
        foreach ($users as $user) {
            $dataId[] = $user->id;
        }

        if (!in_array($id, $dataId)) {
            throw new \Exception('Error ! No find User', 1);
        }

        $result = $this->userRepository->deleteUser($id);
        if (!$result) {
            throw new \Exception('Error ! Delete Data User No Success', 1);
        }

        return $result;
    }

    /**
     * Xử lý các hành động như xóa mềm, xóa vĩnh viễn, khôi phục bản ghi,....
     * @param mixed $listCheck
     * @param mixed $action
     * @throws \Exception
     * @return string
     */
    public function handleUserAction($listCheck, $action)
    {

        if (!$listCheck) {
            throw new \Exception('Error ! You need to select the element to execute', 1);
        }

        foreach ($listCheck as $k => $v) {
            if (Auth::id() == $v) {
                unset($listCheck[$k]);
            }
        }

        $newListCheck = array();
        foreach ($listCheck as $value) {
            $exploded = explode(",", $value);
            $newListCheck[] = $exploded;
        }
        $listCheck = $newListCheck[0];

        if (!empty($listCheck)) {

            if ($action == 'delete') {
                $this->userRepository->userDestroy($listCheck);
                return 'You have successfully deleted the temporary';
            }

            if ($action == 'restore') {
                $this->userRepository->userRestoreTrashed($listCheck);
                return 'You have successfully recovered';
            }

            if ($action == 'forceDelete') {
                $this->userRepository->userForceDelete($listCheck);
                return 'You have successfully permanently deleted';
            }
        }

        throw new \Exception('Error ! You cannot operate on your account', 1);
    }

}
