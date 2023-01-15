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
    protected $videoCourseService;

    public function __construct()
    {
        $this->videoCourseService = new VideoCourseService;
    }

    /**
     *  Thêm video khóa học
     * @param CategoryCourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VideoCourseRequest $request, $courseId)
    {
        $inputData = $request->all();
        $hasFile = $request->hasFile('video');
        $video = $request->file('video');

        try {
            $result = $this->videoCourseService->handleSaveData($inputData, $video, $hasFile, $courseId);
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
            $result = $this->videoCourseService->getAll($status, $search, $sortBy, $sortType, $courseId);
            $countActive = $this->videoCourseService->countRecordActive();
            $countTrash = $this->videoCourseService->countRecordTrash();
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
            $result = $this->videoCourseService->getById($id);
            $result = new VideoCourseResource($result);
            return $this->sendResponse($result, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Cập nhật video khóa học
     * @param UpdateVideoCourseRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateVideoCourseRequest $request, $id)
    {
        $data = $request->all();
        $hasFile = $request->hasFile('video');
        $video = $request->file('video');

        try {
            $this->videoCourseService->handleUpdateData($data, $id, $hasFile, $video);
            return $this->sendResponse([], 'Update Data Success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Xóa tạm thời video khóa học
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->videoCourseService->handleDeleteData($id);
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
            $result = $this->videoCourseService->handleDataAction($listCheck, $action);
            return $this->sendResponse([], $result);
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }
}
