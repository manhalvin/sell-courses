<?php
namespace App\Repositories\Eloquent\API;

use App\Models\CategoryCourse;
use Illuminate\Support\Facades\Auth;

class CategoryCourseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new CategoryCourse;
    }

    /**
     * Thêm danh mục khóa học
     * @param mixed $data
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function createCategoryCourse($data)
    {
        $this->model->name = $data['name'];
        $this->model->slug = $data['slug'];
        $this->model->parent_id = $data['parent_id'];
        if ($data['thumbnail']) {
            $this->model->thumbnail = $data['thumbnail'];
        }
        $this->model->status = $data['status'];
        $this->model->save();
        return $this->model->fresh();
    }

    /**
     * Lấy danh sách tất cả danh mục khóa học
     * combo: status + filter + search + sort + pagination
     * @param mixed $status
     * @param mixed $filters
     * @param mixed $search
     * @param mixed $sortArr
     * @param mixed $perPage
     * @return mixed
     */
    public function getList($status, $filters = [], $search = null, $sortArr = null, $perPage = null)
    {
        $query = $this->model->select('*');

        if ($status == 'trash') {
            $query->onlyTrashed()->latest();
        }

        $orderBy = 'created_at';
        $orderType = 'desc';

        if (!empty($sortArr) && is_array($sortArr)) {
            if (!empty($sortArr['sortBy']) && !empty($sortArr['sortType'])) {
                $orderBy = trim($sortArr['sortBy']);
                $orderType = trim($sortArr['sortType']);
            }
        }

        if (!empty($filters)) {
            $query = $query->where($filters);
        }

        if (!empty($search)) {
            $query = $query->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%{$search}%");
            });
        }

        return !empty($perPage)
        ? $query->orderBy($orderBy, $orderType)->paginate($perPage)
        : $query->orderBy($orderBy, $orderType)->get();
    }

    /**
     * Lấy số lượng bản ghi kích hoạt
     * @return mixed
     */
    public function countRecordActive()
    {
        return $this->model->count();
    }

    /**
     * Lấy số lượng bản ghi đã bị xóa mềm
     * @return int|mixed
     */
    public function countRecordTrash()
    {
        return $this->model->onlyTrashed()->count();
    }

    /**
     *  Kiểm tra bản ghi có tồn tại trong database ?
     * @param mixed $id
     * @return mixed
     */
    public function checkRecordExist($id)
    {
        return $this->model->where('id', $id)->exists();
    }

    /**
     * Lấy thông tin chi tiết danh mục khóa học
     * @param mixed $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Cập nhật danh mục khóa học
     * @param mixed $data
     * @param mixed $id
     * @return mixed
     */
    public function updateCategoryCourse($data, $id)
    {
        return $this->model->find($id)
            ->update($data);
    }

    /**
     * Xóa tạm thời bản ghi
     * @param mixed $id
     * @return mixed
     */
    public function deleteData($id)
    {
        $this->model->find($id)->update([
            'user_deleted' => Auth::user()->name,
        ]);
        return $this->model->find($id)
            ->delete();
    }

    /**
     * Xóa tạm thời hàng loạt bản ghi
     * @param mixed $listCheck
     * @return int
     */
    public function destroyData($listCheck)
    {
        $this->model->WhereId($listCheck)
            ->update([
                'user_deleted' => Auth::user()->name,
            ]);
        return $this->model->destroy($listCheck);
    }

    /**
     * Khôi phục bản ghi đã bị xóa mềm
     * @param mixed $listCheck
     * @return mixed
     */
    public function restoreData($listCheck)
    {
        return $this->model->onlyTrashed()->whereIn('id', $listCheck)->restore();
    }

    /**
     * Xóa vĩnh viễn bản ghi
     * @param mixed $listCheck
     * @return mixed
     */
    public function forceDelete($listCheck)
    {
        return $this->model->onlyTrashed()->whereIn('id', $listCheck)->forceDelete();
    }

    /**
     *  Cập nhật trạng thái bản ghi từ ẩn sang hiện
     * @param mixed $listCheck
     * @return mixed
     */
    public function approveRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 1,
        ]);
    }

    /**
     * Cập nhật trạng thái bản ghi từ hiện sang ẩn
     * @param mixed $listCheck
     * @return mixed
     */
    public function incognitoRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 0,
        ]);
    }

    /**
     * Kiểm tra nhiều bản ghi có tồn tại trong database ?
     * @param mixed $listCheck
     * @return mixed
     */
    public function checkManyRecordExist($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->exists();
    }
}
