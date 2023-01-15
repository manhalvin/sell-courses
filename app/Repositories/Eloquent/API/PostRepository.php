<?php
namespace App\Repositories\Eloquent\API;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostRepository
{
    protected $post;
    protected $postImages;

    public function __construct()
    {
        $this->post = new Post;
        $this->postImages = new PostImage();
    }

    /**
     * Thêm bài viết
     * @param mixed $data
     * @return \Illuminate\Database\Eloquent\post|null
     */
    public function createPost($data)
    {
        $this->post->title = trim($data['title']);
        $this->post->content = trim($data['content']);
        $this->post->slug = $data['slug'];
        if ($data['thumbnail']) {
            $this->post->thumbnail = $data['thumbnail'];
        }
        $this->post->course_id = $data['course_id'];
        $this->post->user_created = Auth::user()->name;
        $this->post->status = $data['status'];
        $this->post->save();
        return $this->post->fresh();
    }

    /**
     * Lấy danh sách tất cả bản ghi
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
        $query = $this->post->select('*');

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

    /**
     * Lấy danh sách bài viết
     * combo: search + pagination
     * @param mixed $search
     * @return mixed
     */
    public function getPostList($search = null)
    {
        $query = $this->post->select('*');

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
     * Lấy số lượng bản ghi kích hoạt
     * @return mixed
     */
    public function countRecordActive()
    {
        return $this->post->count();
    }


    /**
     * Lấy số lượng bản ghi đã bị xóa mềm
     * @return int|mixed
     */
    public function countRecordTrash()
    {
        return $this->post->onlyTrashed()->count();
    }

    /**
     * Kiểm tra bản ghi có tồn tại trong database
     * @param mixed $id
     * @return mixed
     */
    public function checkRecordExist($id)
    {
        return $this->post->where('id', $id)->exists();
    }

    /**
     * Lấy thông tin chi tiết bài viết
     * @param mixed $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->post->find($id);
    }

    /**
     * Cập nhật bài viết
     * @param mixed $data
     * @param mixed $id
     * @return mixed
     */
    public function updatePost($data, $id)
    {
        return $this->post->find($id)
            ->update($data);
    }

    /**
     * Xóa mềm bài viết
     * @param mixed $id
     * @return mixed
     */
    public function deleteData($id)
    {
        $this->post->find($id)->update([
            'user_deleted' => Auth::user()->name
        ]);
        return $this->post->find($id)
            ->delete();
    }

    /**
     * Xóa mềm nhiều bản ghi
     * @param mixed $listCheck
     * @return int
     */
    public function destroyData($listCheck)
    {
        $this->post->WhereIn('id', $listCheck)->update([
            'user_deleted' => Auth::user()->name
        ]);
        return $this->post->destroy($listCheck);
    }

    /**
     * Khôi phục dữ liệu đã bị xóa mềm
     * @param mixed $listCheck
     * @return mixed
     */
    public function restoreData($listCheck)
    {
        return $this->post->onlyTrashed()->whereIn('id', $listCheck)->restore();
    }

    /**
     * Xóa vĩnh viễn bản ghi
     * @param mixed $listCheck
     * @return mixed
     */
    public function forceDelete($listCheck)
    {
        return $this->post->onlyTrashed()->whereIn('id', $listCheck)->forceDelete();
    }

    /**
     * Cập nhật trạng thái bài viết từ ẩn sang hiện
     * @param mixed $listCheck
     * @return mixed
     */
    public function approveRecord($listCheck)
    {
        return $this->post->whereIn('id', $listCheck)->update([
            'status' => 1
        ]);
    }

    /**
     * Cập nhật trạng thái bài viết từ hiện sang ẩn
     * @param mixed $listCheck
     * @return mixed
     */
    public function incognitoRecord($listCheck)
    {
        return $this->post->whereIn('id', $listCheck)->update([
            'status' => 0
        ]);
    }

    /**
     * Kiểm tra nhiều bản ghi có tồn tại trong database
     * @param mixed $listCheck
     * @return mixed
     */
    public function checkManyRecordExist($listCheck)
    {
        return $this->post->whereIn('id', $listCheck)->exists();
    }

    /**
     * Thêm nhiều ảnh vào post
     * @param mixed $data
     * @throws \Exception
     * @return void
     */
    public function saveMultipleImagePost($data)
    {
        return $this->postImages->create($data);
    }

    /**
     * Kiểm tra nhiều ảnh có thuôc 1 bài post
     * @param mixed $postId
     * @return mixed
     */
    public function verifyPostId($postId)
    {
        return $this->postImages->where('post_id', $postId)->get();
    }

    /**
     * Xóa nhiều ảnh của bài post
     * @param mixed $postId
     * @return mixed
     */
    public function deleteImageAll($postId)
    {
        return $this->postImages->where('post_id', $postId)->forceDelete();
    }
}
