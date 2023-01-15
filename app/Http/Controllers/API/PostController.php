<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\API\PostService;
use App\Http\Resources\API\PostResource;
use App\Http\Requests\API\Post\PostRequest;
use App\Http\Requests\API\Post\UpdatePostRequest;
use App\Http\Requests\API\Post\MultipleImagePostRequest;

class PostController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PostService;
    }

    /**
     *  Thêm bài viết
     * @param CategoryCourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        $inputData = $request->all();
        $hasFile = $request->hasFile('thumbnail');
        $thumbnail = $request->thumbnail;

        try {
            $result = $this->model->handleSaveData($inputData, $thumbnail, $hasFile);
            return $this->sendResponse($result, 'Success ! Create data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Hiển thị danh sách post
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $search = "";
        $status = $request->input('status');
        $listAction = [
            'delete' => 'Xóa tạm thời'
        ];
        if($status == 'trash'){
            $listAction = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
        }

        if (!empty($request->search)) {
            $search = $request->search;
        }
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');

        try {
            $result = $this->model->getAll($status, $search, $sortBy, $sortType);
            $countActive = $this->model->countRecordActive();
            $countTrash = $this->model->countRecordTrash();
            $success = [
                'post' => $result,
                'count_active' => $countActive,
                'count_trash' => $countTrash,
                'list_action' => $listAction
            ];
            return $this->sendResponse($success, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     *  Hiển thị thông tin chi tiết  post
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $result = $this->model->getById($id);
            $result = new PostResource($result);
            return $this->sendResponse($result, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Cập nhật bài viết
     * @param UpdatePostRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $data = $request->all();
        $hasFile = $request->hasFile('thumbnail');
        $thumbnail = $request->thumbnail;

        try {
            $this->model->handleUpdateData($data, $id, $hasFile, $thumbnail);
            return $this->sendResponse([], 'Update Data Success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Xóa mềm bài viết
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->model->handleDeleteData($id);
            return $this->sendResponse([], 'Delete Data Success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Thực hiện các hành động như: xóa tạm thời, xóa vĩnh viễn
     * khôi phục hàng loạt bản ghi
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function action(Request $request)
    {
        $listCheck = $request->input('list_check');
        $action = $request->input('action');

        try {
            $result = $this->model->handleDataAction($listCheck, $action);
            return $this->sendResponse([], $result);
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Upload nhiều ảnh (posts)
     * @param MultipleImagePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(MultipleImagePostRequest $request)
    {
        $images = $request->file('image');
        $postId = $request->input('post_id');

        try {
            $this->model->handleUploadMultipleImagePost($images, $postId);
            return $this->sendResponse([], 'Upload image success');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Xóa tất cả hình ảnh của post
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAllImage(Request $request){
        $data = $request->all();
        try {
            $this->model->handleDeleteImageAll($data);
            return $this->sendResponse([], 'Delete image success');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

}
