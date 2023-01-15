<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\API\CourseResource;
use App\Services\API\CourseService;
use Illuminate\Http\Request;

class ClientCourseController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CourseService;
    }

    /**
     * Hiển thị danh sách khóa học
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $search = "";

        if (!empty($request->search)) {
            $search = $request->search;
        }

        try {
            $course = $this->model->getCourseList($search);
            return $this->sendResponse($course, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Hiển thị thông tin chi tiết khóa học
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $course = $this->model->getById($id);
            return $this->sendResponse($course, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Hiển thi danh sách khóa học theo danh mục khóa học
     * @param mixed $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCoursesByCategory($id, Request $request)
    {
        $search = "";

        if (!empty($request->search)) {
            $search = $request->search;
        }

        try {
            $course = $this->model->getCoursesByCategory($search, $id);
            $course = CourseResource::collection($course);
            return $this->sendResponse($course, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Đăng ký học online
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function enroll(Request $request)
    {
        $courseId = $request->input('course_id');

        try {
            $this->model->handleEnroll($courseId);
            return $this->sendResponse([], 'Success ! Register for the online course successfully !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Hủy đăng ký học online
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unenrolled(Request $request)
    {
        $courseId = $request->input('course_id');

        try {
            $this->model->handleUnenrolled($courseId);
            return $this->sendResponse([], 'Success ! Successfully canceled course registration !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }
}
