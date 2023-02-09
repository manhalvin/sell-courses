<?php
namespace App\Services\API;

use App\Enums\Action;
use App\Http\Resources\API\CourseResource;
use App\Repositories\Eloquent\API\CartRepository;
use App\Repositories\Eloquent\API\CourseRepository;
use App\Repositories\Eloquent\API\OrderDetailRepository;
use App\Repositories\Eloquent\API\OrderRepository;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Avatar;

class CourseService extends BaseService
{
    protected $courseRepository;
    protected $orderRepository;
    protected $orderDetailRepository;
    protected $cartRepository;

    public function __construct()
    {
        $this->courseRepository = new CourseRepository;
        $this->orderRepository = new OrderRepository;
        $this->orderDetailRepository = new OrderDetailRepository;
        $this->cartRepository = new CartRepository;
    }

    /**
     * Xử lý chức năng thêm khóa hoc
     * @param mixed $inputData
     * @param mixed $thumbnail
     * @param mixed $hasFile
     * @throws \Exception
     * @return array
     */
    public function handleSaveData($inputData, $thumbnail, $hasFile)
    {
        if (!$hasFile) {
            $avatar = new Avatar();
            $inputData['thumbnail'] = $avatar->create($inputData['title'])->toBase64();
        } else {
            $imageName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('image/course/', $imageName);
            $image = 'image/course/' . $imageName;
            $inputData['thumbnail'] = $image;
        }

        $course = $this->courseRepository->createCourse($inputData);
        if (!$course) {
            throw new \Exception('Error ! Create Data Courses No Success', 1);
        }

        $result = [
            'course_id' => $course->id,
        ];
        return $result;
    }

    /**
     * Xử lý lấy tất cả bản ghi khóa hoc
     * combo filter + search + sort
     * @param mixed $status
     * @param mixed $search
     * @param mixed $sortBy
     * @param mixed $sortType
     * @return void
     */
    public function getAll($status, $search, $sortBy, $sortType)
    {
        $table = 'courses';
        // Lọc trạng thái ẩn hiên
        $filters = [];
        if (!empty($status)) {
            if ($status == 'active') {
                $filters[] = [$table . '.status', '=', 1];
            } elseif ($status == 'Inactive') {
                $filters[] = [$table . '.status', '=', 0];
            }
        }

        // Sắp xếp các cột theo thứ tự desc,asc
        $allowSort = ['asc', 'desc'];
        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            $sortType == 'desc' ? 'asc' : 'desc';
        } else {
            $sortType = 'asc';
        }

        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType,
        ];

        $result = $this->courseRepository->getList($status, $filters, $search, $sortArr, config('services.PER_PAGE'));
        if (!$result->count()) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }

        return CourseResource::collection($result);
    }

    /**
     * Lấy danh sách tất cả khóa hoc
     * @param mixed $search
     * @throws \Exception
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getCourseList($search)
    {
        $result = $this->courseRepository->getCourseList($search, config('services.PER_PAGE'));
        if (!$result->count()) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        return CourseResource::collection($result);
    }

    /**
     * Lấy danh sách khóa hoc theo danh muc khóa hoc
     * @param mixed $search
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function getCoursesByCategory($search, $id)
    {
        $CategoryExist = $this->courseRepository->checkCategoryExist($id);
        if (!$CategoryExist) {
            throw new \Exception('Error ! Not find category course', 1);
        }
        $result = $this->courseRepository->getCoursesByCategory($id, $search, config('services.PER_PAGE'));
        return $result;
    }

    /**
     * Lấy số lương bản ghi kích hoat
     * @return mixed
     */
    public function countRecordActive()
    {
        return $this->courseRepository->countRecordActive();
    }

    /**
     * Lấy số lương bản ghi thùng rác
     * @return int|mixed
     */
    public function countRecordTrash()
    {
        return $this->courseRepository->countRecordTrash();
    }

    /**
     * Lấy thông tin chi tiết khoá học
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function getById($id)
    {
        $item = $this->courseRepository->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        $courseRepository = $this->courseRepository->getById($id);
        return $courseRepository;
    }

    /**
     * Xử lý câp nhât dữ liêu khóa học
     * @param mixed $data
     * @param mixed $id
     * @param mixed $hasFile
     * @param mixed $thumbnail
     * @throws \Exception
     * @return mixed
     */
    public function handleUpdateData($data, $id, $hasFile, $thumbnail)
    {
        $item = $this->courseRepository->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Not find record', 1);
        }

        $course = $this->courseRepository->getById($id);
        if ($hasFile) {
            if (file_exists($course->thumbnail)) {
                unlink($course->thumbnail);
            }
            $imageName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('image/course/', $imageName);
            $image = 'image/course/' . $imageName;
            $data['thumbnail'] = $image;
        }

        $result = $this->courseRepository->updateCourse($data, $id);
        if (!$result) {
            throw new \Exception('Update Data No Success', 1);
        }

        return $result;
    }

    /**
     * Xử lý xóa mềm bản ghi
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function handleDeleteData($id)
    {
        $item = $this->courseRepository->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Not find record', 1);
        }

        $result = $this->courseRepository->deleteData($id);
        if (!$result) {
            throw new \Exception('Delete Data No Success', 1);
        }

        return $result;
    }

    /**
     * Xử lý các hành đông như
     * xóa tạm thời , xóa vĩnh viễn , khôi phuc nhiều bản ghi
     * @param mixed $listCheck
     * @param mixed $action
     * @throws \Exception
     * @return array
     */
    public function handleDataAction($listCheck, $action)
    {
        if (empty($listCheck)) {
            throw new \Exception('Please select the record to perform', 1);
        }

        if (empty($action)) {
            throw new \Exception('Please select the action to perform the recording', 1);
        }

        switch ($action) {

            case Action::Delete:
                $item = $this->courseRepository->checkManyRecordExist($listCheck);
                if (!$item) {
                    throw new \Exception('Record no exist', 1);
                }

                $this->courseRepository->destroyData($listCheck);

                return [
                    'success' => "You have successfully deleted the temporary record",
                ];

            case Action::Active:
                $this->courseRepository->restoreData($listCheck);
                return [
                    'success' => "You have successfully active the record",
                ];

            case Action::ForceDelete:
                $this->courseRepository->forceDelete($listCheck);
                return [
                    'success' => "You have successfully restored the record",
                ];

            case Action::Public:
                $this->courseRepository->approveRecord($listCheck);
                return [
                    'success' => "You have successfully made the record public",
                ];

            default:
                $this->courseRepository->incognitoRecord($listCheck);
                return [
                    'success' => "You have successfully converted the record to pending approval",
                ];
        }

    }

    /**
     * Xử lý chức năng đăng ký 1 khóa hoc online
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function handleEnroll($courseId, $userId)
    {
        $checkCourseExist = $this->courseRepository->checkRecordExist($courseId);
        if (!$checkCourseExist) {
            throw new \Exception('No find course !', 1);
        }

        $course = $this->courseRepository->getById($courseId);
        $sessionId = substr(md5(microtime()), rand(0, 26), 5);

        $cartItem = $this->cartRepository->getCart($courseId, $userId);
        if (!$cartItem) {
            $data = [
                'session_id' => $sessionId,
                'course_id' => $courseId,
                'user_id' => $userId,
                'qty' => 1,
                'title' => $course->title,
                'price' => $course->price,
                'thumbnail' => $course->thumbnail,
            ];
            $this->cartRepository->createCart($data);
        }

        return $cartItem;
    }

    /**
     * Xử lý Hủy đăng ký 1 khóa học online
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function handleUnenrolled($courseId, $userId)
    {
        $checkCourseExist = $this->courseRepository->checkRecordExist($courseId);
        if (!$checkCourseExist) {
            throw new \Exception('No find course !', 1);
        }

        $cart = $this->cartRepository->deleteCourse($courseId, $userId);
        if (!$cart) {
            throw new \Exception('Failed to delete the course from the shopping cart', 1);
        }

        return $cart;
    }

    /**
     * Xử lý tính toán
     * Hiển thi tổng tiền và tổng số lương khóa hoc đã đăt trong cart
     * nhưng chưa thanh toán
     * @return array
     */
    public function infoCart()
    {
        $userId = Auth::id();
        $cart = $this->cartRepository->getCartByUserId($userId);

        if ($cart) {
            $numOrder = 0;
            $total = 0;

            foreach ($cart as $item) {
                $numOrder += $item->qty;
                $total += $item->price;
            }

            $cartInfo = array(
                'num_order' => $numOrder,
                'total' => $total,
            );

            return $cartInfo;
        }
    }

    /**
     *  Xử lý chức năng đăng ký học online nhiều khóa cùng lúc
     * @param array $courseId
     * @param int $userId
     * @throws \Exception
     * @return mixed
     */
    public function handleRegister(array $courseId, int $userId)
    {
        $carts = array();
        $checkCourseId = array();
        $sessionId = substr(md5(microtime()), rand(0, 26), 5);

        $courseExist = $this->courseRepository->checkManyRecordExist($courseId);
        if (!$courseExist) {
            throw new \Exception('No find course !', 1);
        }

        $courses = $this->courseRepository->getMultipleCourses($courseId);
        foreach ($courses as $course) {
            $carts[] = $this->cartRepository->getCart($course->id, $userId);
        };

        // kiểm tra xem người dùng đã đăng ký cho bất kỳ khóa học nào chưa !
        foreach ($carts as $cart) {
            if (!empty($cart->course_id)) {
                $checkCourseId[] = $cart->course_id;
            }
        }

        $checkCourseId = implode(",", $checkCourseId);
        if ($checkCourseId) {
            throw new \Exception("You have already registered for this course: $checkCourseId", 1);
        }

        // Tạo đăng ký học online mới
        foreach ($courses as $course) {
            $data = [
                'session_id' => $sessionId,
                'course_id' => $course->id,
                'user_id' => $userId,
                'qty' => 1,
                'title' => $course->title,
                'price' => $course->price,
                'thumbnail' => $course->thumbnail,
            ];
            $result = $this->cartRepository->createCart($data);
        }

        return $result;
    }

    /**
     * Xử lý xóa tất cả khóa học ra khỏi cart.
     * @throws \Exception
     * @return mixed
     */
    public function handleCancelRegister()
    {
        $result = $this->cartRepository->truncate();
        if (!$result) {
            throw new \Exception('Delete all record fail', 1);
        }

        return $result;
    }

}
