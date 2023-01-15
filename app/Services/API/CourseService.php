<?php
namespace App\Services\API;

use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\API\CourseResource;
use App\Repositories\Eloquent\API\CartRepository;
use App\Repositories\Eloquent\API\OrderRepository;
use App\Repositories\Eloquent\API\CourseRepository;
use App\Repositories\Eloquent\API\OrderDetailRepository;

class CourseService extends BaseService
{
    protected $courseRepository;
    protected $table = 'courses';
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
     * Xử lý lưu dữ liệu khóa hoc
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
     * Xử lý lấy tất cả bản ghi khóa hoc có bô lọc
     * @param mixed $status
     * @param mixed $search
     * @param mixed $sortBy
     * @param mixed $sortType
     * @return void
     */
    public function getAll($status, $search, $sortBy, $sortType)
    {
        // Lọc trạng thái ẩn hiên
        $filters = [];
        if (!empty($status)) {
            if ($status == 'active') {
                $filters[] = [$this->table . '.status', '=', 1];
            } elseif ($status == 'unactive') {
                $filters[] = [$this->table . '.status', '=', 0];
            }
        }

        // Sắp xếp các cột theo thứ tự desc,asc
        $allowSort = ['asc', 'desc'];
        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            if ($sortType == 'desc') {
                $sortType = 'asc';
            } else {
                $sortType = 'desc';
            }
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
     * Lấy danh sách khóa hoc
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
        $checkCategoryExist = $this->courseRepository->checkCategoryExist($id);
        if (!$checkCategoryExist) {
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
            throw new \Exception('Error ! Update Data No Success', 1);
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
            throw new \Exception('Error ! Not find record', 1);
        }

        $result = $this->courseRepository->deleteData($id);
        if (!$result) {
            throw new \Exception('Error ! Delete Data No Success', 1);
        }

        return $result;
    }

    /**
     * Xử lý các hành đông như xóa tạm thời , xóa vĩnh viễn , khôi phuc bản ghi
     * @param mixed $listCheck
     * @param mixed $action
     * @throws \Exception
     * @return string
     */
    public function handleDataAction($listCheck, $action)
    {
        if (empty($listCheck)) {
            throw new \Exception('Please select the record to perform', 1);
        }

        if (empty($action)) {
            throw new \Exception('Please select the action to perform the recording', 1);
        }

        $newListCheck = array();
        foreach ($listCheck as $value) {
            $exploded = explode(",", $value);
            $newListCheck[] = $exploded;
        }
        $listCheck = $newListCheck[0];

        if ($action == 'delete') {

            $item = $this->courseRepository->checkManyRecordExist($listCheck);
            if (!$item) {
                throw new \Exception('Record no exist', 1);
            }

            $this->courseRepository->destroyData($listCheck);
            return 'You have successfully deleted the temporary record';

        } elseif ($action == 'active') {
            $this->courseRepository->restoreData($listCheck);
            return 'You have successfully restored the record';

        } elseif ($action == 'forceDelete') {
            $this->courseRepository->forceDelete($listCheck);
            return 'You have successfully restored the record';

        } elseif ($action == 'public') {
            $this->courseRepository->approveRecord($listCheck);
            return 'You have successfully made the record public';

        } else {
            $this->courseRepository->incognitoRecord($listCheck);
            return 'You have successfully converted the record to pending approval';
        }
    }

    /**
     * Xử lý chức năng đăng ký 1 khóa hoc online
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function handleEnroll($id)
    {
        $checkCourseExist = $this->courseRepository->checkRecordExist($id);
        if (!$checkCourseExist) {
            throw new \Exception('Error ! No find course !', 1);
        }

        $qty = 1;
        $course = $this->courseRepository->getById($id);
        $sessionId = substr(md5(microtime()), rand(0, 26), 5);
        $userId = Auth::user()->id;

        $cartItem = $this->cartRepository->getCart($id, $userId);
        if ($cartItem) {
            $cartItem->qty = $qty;
            $cartItem->save();
        } else {
            $data = [
                'session_id' => $sessionId,
                'course_id' => $id,
                'user_id' => $userId,
                'qty' => $qty,
                'title' => $course->title,
                'price' => $course->price,
                'thumbnail' => $course->thumbnail
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
    public function handleUnenrolled($id)
    {
        $checkCourseExist = $this->courseRepository->checkRecordExist($id);
        if (!$checkCourseExist) {
            throw new \Exception('Error ! No find course !', 1);
        }

        $userId = Auth::user()->id;

        $cart = $this->cartRepository->deleteCourse($id, $userId);
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
        $userId = Auth::user()->id;
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

}
