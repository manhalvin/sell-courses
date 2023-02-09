<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Services\API\CourseService;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\API\CourseResource;
use App\Http\Controllers\API\BaseController;

class ClientCourseController extends BaseController
{
    protected $courseService;

    public function __construct()
    {
        $this->courseService = new CourseService;
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
            $course = $this->courseService->getCourseList($search);
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
            $course = $this->courseService->getById($id);
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
            $course = $this->courseService->getCoursesByCategory($search, $id);
            $course = CourseResource::collection($course);
            return $this->sendResponse($course, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Đăng ký học online 1 khóa
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function enroll(Request $request)
    {
        $courseId = $request->input('course_id');
        $userId = Auth::user()->id;

        try {
            $this->courseService->handleEnroll($courseId, $userId);
            return $this->sendResponse([], 'Success ! Register for the online course successfully !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Hủy đăng ký học online 1 khóa
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unenrolled(Request $request)
    {
        $courseId = $request->input('course_id');
        $userId = Auth::user()->id;

        try {
            $this->courseService->handleUnenrolled($courseId, $userId);
            return $this->sendResponse([], 'Success ! Successfully canceled course registration !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    // Đăng ký học online nhiều khóa cùng lúc
    public function register(Request $request)
    {
        $courseId = $request->input('course_id');
        $userId = Auth::user()->id;

        try {
            $this->courseService->handleRegister($courseId, $userId);
            return $this->sendResponse([], 'Register online for courses successful!');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Xóa tất cả khóa học ra khỏi giỏ hàng
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelRegister()
    {
        try {
            $this->courseService->handleCancelRegister();
            return $this->sendResponse([], 'Cannel Register online for courses successful!');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }
}
