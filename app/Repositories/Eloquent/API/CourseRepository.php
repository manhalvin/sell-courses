<?php
namespace App\Repositories\Eloquent\API;

use App\Models\CategoryCourse;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseRepository
{
    protected $course;
    protected $categoryCourse;

    public function __construct()
    {
        $this->course = new Course;
        $this->categoryCourse = new CategoryCourse;
    }

    /**
     * Tạo khóa học
     * @param mixed $data
     * @return \Illuminate\Database\Eloquent\course|null
     */
    public function createCourse($data)
    {
        $this->course->title = $data['title'];
        $this->course->content = $data['content'];
        $this->course->slug = $data['slug'];
        if ($data['thumbnail']) {
            $this->course->thumbnail = $data['thumbnail'];
        }
        $this->course->price = $data['price'];
        $this->course->category_course_id = $data['category_course_id'];
        $this->course->user_created = Auth::user()->name;
        $this->course->status = $data['status'];
        $this->course->save();
        return $this->course->fresh();
    }

    /**
     * Lấy danh sách khóa hoc
     * combo: filter + search + sort + pagination
     * @param mixed $status
     * @param mixed $filters
     * @param mixed $search
     * @param mixed $sortArr
     * @param mixed $perPage
     * @return mixed
     */
    public function getList($status, $filters = [], $search = null, $sortArr = null, $perPage = null)
    {
        $query = $this->course->select('*');

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
     * Lấy danh sách khóa hoc
     * combo: search + pagination
     * @param mixed $search
     * @param mixed $perPage
     * @return mixed
     */
    public function getCourseList($search = null, $perPage = null)
    {
        $query = $this->course->select('*');

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
        $query = $this->course
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
        return $this->course->count();
    }

    /**
     *  Lây sô lương bản ghi đã bi xóa mềm
     * @return int|mixed
     */
    public function countRecordTrash()
    {
        return $this->course->onlyTrashed()->count();
    }

    /**
     * Kiểm tra 1 bản ghi có tồn tai trong database
     * @param mixed $id
     * @return mixed
     */
    public function checkRecordExist($id)
    {
        return $this->course->where('id', $id)->exists();
    }

    // Thông tin chi tiêt khóa hoc
    public function getById($id)
    {
        return $this->course->find($id);
    }

    /**
     * Câp nhât khóa học theo id của khóa hoc
     * @param mixed $data
     * @param mixed $id
     * @return mixed
     */
    public function updateCourse($data, $id)
    {
        return $this->course->find($id)
            ->update($data);
    }

    /**
     * Xóa tam thời 1 bản ghi
     * @param mixed $id
     * @return mixed
     */
    public function deleteData($id)
    {
        $this->course->find($id)->update([
            'user_deleted' => Auth::user()->name,
        ]);
        return $this->course->find($id)
            ->delete();
    }

    /**
     * Xóa tam thời nhiều bản ghi
     * @param mixed $listCheck
     * @return int
     */
    public function destroyData($listCheck)
    {
        $this->course->WhereIn('id', $listCheck)->update([
            'user_deleted' => Auth::user()->name,
        ]);
        return $this->course->destroy($listCheck);
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
        return $this->course->withTrashed()->whereIn('id', $listCheck)->restore();
    }

    /**
     *  Xóa vĩnh viễn một bản ghi
     * @param mixed $listCheck
     * @return mixed
     */
    public function forceDelete($listCheck)
    {
        return $this->course->withTrashed()->whereIn('id', $listCheck)->forceDelete();
    }

    // Câp nhât trang thái bản ghi: phê duyêt
    public function approveRecord($listCheck)
    {
        return $this->course->whereIn('id', $listCheck)->update([
            'status' => 1,
        ]);
    }

    // Câp nhât trang thái bản ghi: chưa phê duyêt
    public function incognitoRecord($listCheck)
    {
        return $this->course->whereIn('id', $listCheck)->update([
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
        return $this->course->whereIn('id', $listCheck)->exists();
    }

    /**
     *  Truy xuất tất cả các bản ghi có giá trị của cột id trong mảng đã cho của id khóa học
     * @param array $courseId
     * @return mixed
     */
    public function getMultipleCourses(array $courseId)
    {
        return $this->course->whereIn('id', $courseId)->get();
    }

    /**
     * Xóa tất cả bản ghi trong database
     * @return mixed
     */
    public function truncate()
    {
        return $this->course->truncate();
    }
}
