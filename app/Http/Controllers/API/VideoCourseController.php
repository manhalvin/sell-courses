<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\API\VideoCourseService;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\API\VideoCourseResource;
use App\Http\Requests\API\VideoCourse\VideoCourseRequest;
use App\Http\Requests\API\VideoCourse\UpdateVideoCourseRequest;

class VideoCourseController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new VideoCourseService;
    }

    /**
     *  Lưu dữ liêu video khóa học
     * @param CategoryCourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VideoCourseRequest $request, $courseId)
    {
        $inputData = $request->all();
        $hasFile = $request->hasFile('video');
        $video = $request->file('video');

        try {
            $result = $this->model->handleSaveData($inputData, $video, $hasFile, $courseId);
            return $this->sendResponse($result, 'Success ! Create data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Hiển thị danh sách video khóa hoc
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $courseId)
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
            $result = $this->model->getAll($status, $search, $sortBy, $sortType, $courseId);
            $countActive = $this->model->countRecordActive();
            $countTrash = $this->model->countRecordTrash();
            $success = [
                'course' => $result,
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
     *  Hiển thị thông tin chi tiết video khóa hoc
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $result = $this->model->getById($id);
            $result = new VideoCourseResource($result);
            return $this->sendResponse($result, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    public function update(UpdateVideoCourseRequest $request, $id)
    {
        $data = $request->all();
        $hasFile = $request->hasFile('video');
        $video = $request->file('video');

        try {
            $this->model->handleUpdateData($data, $id, $hasFile, $video);
            return $this->sendResponse([], 'Update Data Success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    public function destroy($id)
    {
        try {
            $this->model->handleDeleteData($id);
            return $this->sendResponse([], 'Delete Data Success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

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
}
