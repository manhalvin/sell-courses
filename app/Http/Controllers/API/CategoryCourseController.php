<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\API\CategoryCourse\CategoryCourseRequest;
use App\Http\Requests\API\CategoryCourse\UpdateCategoryCourseRequest;
use App\Http\Resources\API\CategoryCourseResource;
use App\Services\API\CategoryCourseService;
use Illuminate\Http\Request;

class CategoryCourseController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CategoryCourseService();
    }

    /**
     *  Lưu dữ liêu danh mục khóa học
     * @param CategoryCourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryCourseRequest $request)
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
                'category_course' => $result,
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
            $result = new CategoryCourseResource($result);
            return $this->sendResponse($result, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Cập nhật danh mục khóa học
     * @param UpdateCategoryCourseRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryCourseRequest $request, $id)
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
     * Xóa danh mục khóa học
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

}
