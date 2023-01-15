<?php
namespace App\Repositories\Eloquent\API;

use App\Models\CourseEpisode;
use Illuminate\Support\Facades\Auth;

class VideoCourseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new CourseEpisode;
    }

    /**
     * Tạo video khóa học
     * @param mixed $data
     * @param mixed $courseId
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function createCourseVideo($data, $courseId)
    {
        $this->model->title = $data['title'];
        $this->model->content = $data['content'];
        if ($data['video']) {
            $this->model->link_video = $data['video'];
        }
        $this->model->episodes = $data['episodes'];
        $this->model->course_id = $data['course_id'];
        $this->model->user_created = Auth::user()->name;
        $this->model->status = $data['status'];
        $this->model->save();
        return $this->model->fresh();
    }

    /**
     * Lấy danh sách video khóa học
     * combo: status + filter + search + sort + pagination
     * @param mixed $status
     * @param mixed $filters
     * @param mixed $search
     * @param mixed $sortArr
     * @param mixed $perPage
     * @param mixed $courseId
     * @return mixed
     */
    public function getList($status, $filters = [], $search = null, $sortArr = null, $perPage = null, $courseId)
    {
        $query = $this->model->select('*')
            ->where('course_id', '=', $courseId);

        if($status == 'trash'){
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
     * Kiểm tra bản ghi có tồn tại trong database
     * @param mixed $id
     * @return mixed
     */
    public function checkRecordExist($id)
    {
        return $this->model->where('id', $id)->exists();
    }

    /**
     * Lấy thông tin chi tiết video khóa học
     * @param mixed $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Cập nhật video khóa học
     * @param mixed $data
     * @param mixed $id
     * @return mixed
     */
    public function updateVideoCourse($data, $id)
    {
        return $this->model->find($id)
            ->update($data);
    }

    /**
     * Xóa mền bản ghi
     * @param mixed $id
     * @return mixed
     */
    public function deleteData($id)
    {
        $this->model->find($id)->update([
            'user_deleted' => Auth::user()->name
        ]);
        return $this->model->find($id)
            ->delete();
    }

    /**
     * Xóa mềm nhiều bản ghi
     * @param mixed $listCheck
     * @return int
     */
    public function destroyData($listCheck)
    {
        $this->model->WhereIn('id', $listCheck)->update([
            'user_deleted' => Auth::user()->name
        ]);
        return $this->model->destroy($listCheck);
    }

    /**
     * Khôi phục dữ liệu đã bị xóa mềm
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
     * Cập nhật trạng thái video từ ẩn sang hiện
     * @param mixed $listCheck
     * @return mixed
     */
    public function approveRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 1
        ]);
    }

    /**
     * Cập nhật trạng thái video từ hiện sang ẩn
     * @param mixed $listCheck
     * @return mixed
     */
    public function incognitoRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 0
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
