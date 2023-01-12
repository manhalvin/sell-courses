<?php
namespace App\Services\API;

use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\API\CourseResource;
use App\Repositories\Eloquent\API\CartRepository;
use App\Repositories\Eloquent\API\OrderRepository;
use App\Repositories\Eloquent\API\CourseRepository;
use App\Repositories\Eloquent\API\OrderDetailRepository;

class CourseService extends BaseService
{
    protected $model;
    protected $table = 'courses';
    protected $orderRepository;
    protected $orderDetailRepository;
    protected $CartRepository;

    public function __construct()
    {
        $this->model = new CourseRepository;
        $this->orderRepository = new OrderRepository;
        $this->orderDetailRepository = new OrderDetailRepository;
        $this->CartRepository = new CartRepository;
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

        $course = $this->model->createCourse($inputData);
        if (!$course) {
            throw new \Exception('Error ! Create Data Courses No Success', 1);
        }
        $result = [
            'course_id' => $course->id,
        ];
        return $result;
    }

    /**
     * Xử lý lấy danh sách khóa học
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

        $result = $this->model->getList($status, $filters, $search, $sortArr, config('services.PER_PAGE'));
        if (!$result->count()) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        return CourseResource::collection($result);
    }

    public function getCourseList($search)
    {
        $result = $this->model->getCourseList($search, config('services.PER_PAGE'));
        if (!$result->count()) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        return CourseResource::collection($result);
    }

    public function getCoursesByCategory($search, $id)
    {
        $checkCategoryExist = $this->model->checkCategoryExist($id);
        if (!$checkCategoryExist) {
            throw new \Exception('Error ! Not find category course', 1);
        }
        $result = $this->model->getCoursesByCategory($id, $search, config('services.PER_PAGE'));
        return $result;
    }
    public function countRecordActive()
    {
        return $this->model->countRecordActive();
    }

    public function countRecordTrash()
    {
        return $this->model->countRecordTrash();
    }

    public function getById($id)
    {
        $item = $this->model->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        $model = $this->model->getById($id);
        return $model;
    }

    public function handleUpdateData($data, $id, $hasFile, $thumbnail)
    {
        $item = $this->model->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Not find record', 1);
        }

        $course = $this->model->getById($id);
        if ($hasFile) {
            if (file_exists($course->thumbnail)) {
                unlink($course->thumbnail);
            }
            $imageName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('image/course/', $imageName);
            $image = 'image/course/' . $imageName;
            $data['thumbnail'] = $image;
        }

        $result = $this->model->updateCategoryCourse($data, $id);
        if (!$result) {
            throw new \Exception('Error ! Update Data No Success', 1);
        }

        return $result;
    }

    public function handleDeleteData($id)
    {
        $item = $this->model->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Not find record', 1);
        }

        $result = $this->model->deleteData($id);
        if (!$result) {
            throw new \Exception('Error ! Delete Data No Success', 1);
        }

        return $result;
    }

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

            $item = $this->model->checkManyRecordExist($listCheck);
            if (!$item) {
                throw new \Exception('Record no exist', 1);
            }

            $this->model->destroyData($listCheck);
            return 'You have successfully deleted the temporary record';

        } elseif ($action == 'active') {
            $this->model->restoreData($listCheck);
            return 'You have successfully restored the record';

        } elseif ($action == 'forceDelete') {
            $this->model->forceDelete($listCheck);
            return 'You have successfully restored the record';

        } elseif ($action == 'public') {
            $this->model->approveRecord($listCheck);
            return 'You have successfully made the record public';

        } else {
            $this->model->incognitoRecord($listCheck);
            return 'You have successfully converted the record to pending approval';
        }
    }

    public function handleEnroll($id)
    {
        $checkCourseExist = $this->model->checkRecordExist($id);
        if (!$checkCourseExist) {
            throw new \Exception('Error ! No find course !', 1);
        }
        $qty = 1;
        $course = $this->model->getById($id);
        $sessionId = substr(md5(microtime()), rand(0, 26), 5);
        $userId = Auth::user()->id;

        $cartItem = $this->CartRepository->getCart($id, $userId);
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
            $this->CartRepository->createCart($data);
        }
        return $cartItem;
    }

    public function infoCart()
    {

        $userId = Auth::user()->id;
        $cart = $this->CartRepository->getCartByUserId($userId);
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
