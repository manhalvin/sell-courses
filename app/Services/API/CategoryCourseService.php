<?php
namespace App\Services\API;

use App\Http\Resources\API\CategoryCourseResource;
use App\Repositories\Eloquent\API\CategoryCourseRepository;
use Laravolt\Avatar\Avatar;

class CategoryCourseService extends BaseService
{
    protected $categoryCourse;
    protected $table = 'category_courses';

    public function __construct()
    {
        $this->categoryCourse = new CategoryCourseRepository;
    }

    /**
     * Xử lý thêm danh muc khóa hoc
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
            $inputData['thumbnail'] = $avatar->create($inputData['name'])->toBase64();
        } else {
            $imageName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('image/category/course/', $imageName);
            $image = 'image/category/course/' . $imageName;
            $inputData['thumbnail'] = $image;
        }

        $categoryCourse = $this->categoryCourse->createCategoryCourse($inputData);
        if (!$categoryCourse) {
            throw new \Exception('Error ! Create Data Category Courses No Success', 1);
        }
        $result = [
            'category_course_id' => $categoryCourse->id,
        ];
        return $result;
    }

    /**
     * Xử lý lấy danh sách danh muc khóa học
     * combo: filter status + search + sort by + pagination
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

        $result = $this->categoryCourse->getList($status, $filters, $search, $sortArr, config('services.PER_PAGE'));
        if (!$result->count()) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        return CategoryCourseResource::collection($result);
    }

    /**
     * Lấy số lượng bản ghi kích hoat
     * @return mixed
     */
    public function countRecordActive()
    {
        return $this->categoryCourse->countRecordActive();
    }

    /**
     * Lấy số lương bản ghi thùng rác
     * @return int|mixed
     */
    public function countRecordTrash()
    {
        return $this->categoryCourse->countRecordTrash();
    }

    /**
     * Lấy thông tin chi tiêt danh muc khóa hoc
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function getById($id)
    {
        $item = $this->categoryCourse->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        $categoryCourse = $this->categoryCourse->getById($id);
        return $categoryCourse;
    }

    /**
     * Xử lý Cập nhật danh mục khóa hoc
     * @param mixed $data
     * @param mixed $id
     * @param mixed $hasFile
     * @param mixed $thumbnail
     * @throws \Exception
     * @return mixed
     */
    public function handleUpdateData($data, $id, $hasFile, $thumbnail)
    {
        $item = $this->categoryCourse->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Not find record', 1);
        }

        if ($hasFile) {
            $imageName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('image/category/course/', $imageName);
            $image = 'image/category/course/' . $imageName;
            $data['thumbnail'] = $image;
        }

        $result = $this->categoryCourse->updateCategoryCourse($data, $id);
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
        $item = $this->categoryCourse->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Not find record', 1);
        }

        $result = $this->categoryCourse->deleteData($id);
        if (!$result) {
            throw new \Exception('Error ! Delete Data No Success', 1);
        }

        return $result;
    }

    /**
     * Xử lý các hành đông như
     * xóa mềm , xóa vĩnh viễn , khôi phuc nhiều bản ghi
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
            $newListCheck[] = explode(",", $value);
        }
        $listCheck = $newListCheck[0];

        if ($action == 'delete') {

            $item = $this->categoryCourse->checkManyRecordExist($listCheck);
            if (!$item) {
                throw new \Exception('Record no exist', 1);
            }

            $this->categoryCourse->destroyData($listCheck);
            return 'You have successfully deleted the temporary record';

        } elseif ($action == 'active') {
            $this->categoryCourse->restoreData($listCheck);
            return 'You have successfully restored the record';

        } elseif ($action == 'forceDelete') {
            $this->categoryCourse->forceDelete($listCheck);
            return 'You have successfully restored the record';

        } elseif ($action == 'public') {
            $this->categoryCourse->approveRecord($listCheck);
            return 'You have successfully made the record public';

        } else {
            $this->categoryCourse->incognitoRecord($listCheck);
            return 'You have successfully converted the record to pending approval';
        }
    }

}
