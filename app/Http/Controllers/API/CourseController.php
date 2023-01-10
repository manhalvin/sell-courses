<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\API\CourseService;
use App\Http\Resources\API\CourseResource;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\API\Course\CourseRequest;
use App\Http\Requests\API\Course\UpdateCourseRequest;

class CourseController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CourseService;
    }

    /**
     *  Lưu dữ liêu danh mục khóa học
     * @param CategoryCourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CourseRequest $request)
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
     * Hiển thị danh sách danh muc khóa hoc
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
     *  Hiển thị thông tin chi tiết danh muc khóa hoc
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $result = $this->model->getById($id);
            $result = new CourseResource($result);
            return $this->sendResponse($result, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    public function update(UpdateCourseRequest $request, $id)
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
