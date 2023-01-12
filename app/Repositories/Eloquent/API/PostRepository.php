<?php
namespace App\Repositories\Eloquent\API;

use App\Models\Post;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Post;
    }

    public function createPost($data)
    {
        $this->model->title = $data['title'];
        $this->model->content = $data['content'];
        $this->model->slug = $data['slug'];
        if ($data['thumbnail']) {
            $this->model->thumbnail = $data['thumbnail'];
        }
        $this->model->course_id = $data['course_id'];
        $this->model->user_created = Auth::user()->name;
        $this->model->status = $data['status'];
        $this->model->save();
        return $this->model->fresh();
    }

    public function getList($status, $filters = [], $search = null, $sortArr = null, $perPage = null)
    {
        $query = $this->model->select('*');

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
                $query->orWhere('title', 'like', "%{$search}%");
            });
        }

        return !empty($perPage)
        ? $query->orderBy($orderBy, $orderType)->paginate($perPage)
        : $query->orderBy($orderBy, $orderType)->get();
    }

    public function getPostList($search = null)
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

    public function countRecordActive()
    {
        return $this->model->count();
    }

    public function countRecordTrash()
    {
        return $this->model->onlyTrashed()->count();
    }

    public function checkRecordExist($id)
    {
        return $this->model->where('id', $id)->exists();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function updatePost($data, $id)
    {
        return $this->model->find($id)
            ->update($data);
    }

    public function deleteData($id)
    {
        $this->model->find($id)->update([
            'user_deleted' => Auth::user()->name
        ]);
        return $this->model->find($id)
            ->delete();
    }

    public function destroyData($listCheck)
    {
        $this->model->WhereIn('id', $listCheck)->update([
            'user_deleted' => Auth::user()->name
        ]);
        return $this->model->destroy($listCheck);
    }

    public function restoreData($listCheck)
    {
        return $this->model->onlyTrashed()->whereIn('id', $listCheck)->restore();
    }

    public function forceDelete($listCheck)
    {
        return $this->model->onlyTrashed()->whereIn('id', $listCheck)->forceDelete();
    }

    public function approveRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 1
        ]);
    }

    public function incognitoRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 0
        ]);
    }

    public function checkManyRecordExist($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->exists();
    }

    public function saveMultipleImagePost($data)
    {
        DB::beginTransaction();

        try {
            $this->model->create($data);
            DB::commit();
        } catch (\Exception$e) {
            DB::rollBack();
            throw new \Exception('Update Data Success');
        }
    }

    /**
     * Kiểm tra nhiều ảnh có thuôc 1 bài post
     * @param mixed $postId
     * @return mixed
     */
    public function verifyPostId($postId)
    {
        return $this->model->where('post_id', $postId)->get();
    }

    /**
     * Xóa nhiều ảnh của bài post
     * @param mixed $postId
     * @return mixed
     */
    public function deleteImageAll($postId)
    {
        return $this->model->where('post_id', $postId)->delete();
    }
}
