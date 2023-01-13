<?php
namespace App\Repositories\Eloquent\API;

use App\Models\CategoryCourse;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseRepository
{
    protected $model;
    protected $categoryCourse;

    public function __construct()
    {
        $this->model = new Course;
        $this->categoryCourse = new CategoryCourse;
    }

    /**
     * Tạo khóa học
     * @param mixed $data
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function createCourse($data)
    {
        $this->model->title = $data['title'];
        $this->model->content = $data['content'];
        $this->model->slug = $data['slug'];
        if ($data['thumbnail']) {
            $this->model->thumbnail = $data['thumbnail'];
        }
        $this->model->price = $data['price'];
        $this->model->category_course_id = $data['category_course_id'];
        $this->model->user_created = Auth::user()->name;
        $this->model->status = $data['status'];
        $this->model->save();
        return $this->model->fresh();
    }

    /**
     * Lấy danh sách khóa hoc có combo: filter + search + sort + pagination
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
     * Lấy danh sach khóa hoc combo: search + pagination
     * @param mixed $search
     * @param mixed $perPage
     * @return mixed
     */
    public function getCourseList($search = null, $perPage = null)
    {
        $query = $this->model->select('*');

        $orderBy = 'created_at';
        $orderType = 'desc';

        if (!empty($search)) {
            $query = $query->where(function ($query) use ($search) {
                $query->orWhere('title', 'like', "%{$search}%");
            });
        }

        return !empty($perPage)
        ? $query->orderBy($orderBy, $orderType)->paginate($perPage)
        : $query->orderBy($orderBy, $orderType)->get();
    }

    /**
     * Kiểm tra danh muc khóa học có tồn tai ktrong database
     * @param mixed $id
     * @return mixed
     */
    public function checkCategoryExist($id)
    {
        return $this->categoryCourse->where('id', $id)->exists();
    }

    /**
     * Lây khóa hoc theo danh muc khóa hoc (combo: search + pagination)
     * @param mixed $id
     * @param mixed $search
     * @param mixed $perPage
     * @return mixed
     */
    public function getCoursesByCategory($id, $search = null, $perPage = null)
    {
        $query = $this->model
            ->where('category_course_id', $id);

        if (!empty($search)) {
            $query = $query->where(function ($query) use ($search) {
                $query->orWhere('title', 'like', "%{$search}%");
            });
        }

        if (!empty($perPage)) {
            $query = $query->paginate($perPage);
        } else {
            $query = $query->get();
        }

        return $query;
    }

    /**
     * Lấy số lương bản ghi chưa xóa
     * @return mixed
     */
    public function countRecordActive()
    {
        return $this->model->count();
    }

    /**
     *  Lây sô lương bản ghi đã bi xóa mềm
     * @return int|mixed
     */
    public function countRecordTrash()
    {
        return $this->model->onlyTrashed()->count();
    }

    /**
     * Kiểm tra 1 bản ghi có tồn tai trong database
     * @param mixed $id
     * @return mixed
     */
    public function checkRecordExist($id)
    {
        return $this->model->where('id', $id)->exists();
    }

    // Thông tin chi tiêt khóa hoc
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Câp nhât khóa học theo id của khóa hoc
     * @param mixed $data
     * @param mixed $id
     * @return mixed
     */
    public function updateCourse($data, $id)
    {
        return $this->model->find($id)
            ->update($data);
    }

    /**
     * Xóa tam thời 1 bản ghi
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
     * Xóa tam thời nhiều bản ghi
     * @param mixed $listCheck
     * @return int
     */
    public function destroyData($listCheck)
    {
        $this->model->WhereIn('id', $listCheck)->update([
            'user_deleted' => Auth::user()->name,
        ]);
        return $this->model->destroy($listCheck);
    }

    /**
     * Khôi phuc bản ghi
     * withTrashed(): trả về tất cả các bản ghi, bao gồm cả những bản ghi đã bị xóa (soft delete) và chưa bị xóa.
     * onlyTrashed(): chỉ trả về các bản ghi đã bị xóa (soft delete) trong cơ sở dữ liệu
     * @param mixed $listCheck
     * @return mixed
     */
    public function restoreData($listCheck)
    {
        return $this->model->withTrashed()->whereIn('id', $listCheck)->restore();
    }

    /**
     *  Xóa vĩnh viễn một bản ghi
     * @param mixed $listCheck
     * @return mixed
     */
    public function forceDelete($listCheck)
    {
        return $this->model->withTrashed()->whereIn('id', $listCheck)->forceDelete();
    }

    // Câp nhât trang thái bản ghi: phê duyêt
    public function approveRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 1,
        ]);
    }

    // Câp nhât trang thái bản ghi: chưa phê duyêt
    public function incognitoRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 0,
        ]);
    }

    /**
     * Kiểm tra nhiều bản ghi có tồn tai trong database
     * @param mixed $listCheck
     * @return mixed
     */
    public function checkManyRecordExist($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->exists();
    }
}
