<?php
namespace App\Services\API;

use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\API\UserResource;
use App\Repositories\Eloquent\API\UserRepository;

class UserService extends BaseService
{
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function getUserList($status, $roleId, $search, $sortBy, $sortType)
    {
        // Lọc trạng thái tài khoản
        $filters = [];
        if (!empty($status)) {
            if ($status == 'active') {
                $status = 1;
            } elseif($status == 'unactive') {
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

    public function handleSaveUserData($data, $thumbnail, $hasFile)
    {
        if (!$hasFile) {
            $avatar = new Avatar();
            $data['thumbnail'] = $avatar->create($data['name'])->toBase64();
        } else {
            $imageName = $thumbnail->getClientOriginalName();
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
        $users = $this->userRepository->getUserAll();
        $dataId = [];
        foreach ($users as $user) {
            $dataId[] = $user->id;
        }

        if (!in_array($id, $dataId)) {
            throw new \Exception('Error ! No find User', 1);
        }

        if ($hasFile) {
            $imageName = $thumbnail->getClientOriginalName();
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

    // function list(Request $request) {
    //     if ($this->authorize('xem-thanh-vien')) {
    //         $status = $request->input('status');
    //         $list_act = [
    //             'delete' => 'Xóa tạm thời'
    //         ];

    //         if ($status == 'trash') {
    //             $users = User::onlyTrashed()->latest()->paginate(5);
    //             $list_act = [
    //                 'restore' => 'Khôi ngục',
    //                 'forceDelete' => 'Xóa vĩnh viễn'
    //             ];
    //         } else {
    //             $req = "";
    //             if ($request->keyword) {
    //                 $req = $request->keyword;
    //             }
    //             $users = User::where('name', 'like', "%{$req}%")->latest()->paginate(5);
    //         }

    //         // dd($users);
    //         $count_active = User::count();
    //         $count_trash = User::onlyTrashed()->count();

    //         $count = [$count_active, $count_trash];

    //         return view('admin.user.list', compact('users', 'count', 'list_act'));
    //     }
    // }
}
