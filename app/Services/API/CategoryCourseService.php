<?php
namespace App\Services\API;

use App\Http\Resources\API\CategoryCourseResource;
use App\Repositories\Eloquent\API\CategoryCourseRepository;
use Laravolt\Avatar\Avatar;

class CategoryCourseService extends BaseService
{
    protected $model;
    protected $table = 'category_courses';

    public function __construct()
    {
        $this->model = new CategoryCourseRepository;
    }

    /**
     * Xử lý lưu dữ liệu danh muc khóa hoc
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
            // $imageName = pathinfo($thumbnail->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('image/category/course/', $imageName);
            $image = 'image/category/course/' . $imageName;
            $inputData['thumbnail'] = $image;
        }

        $categoryCourse = $this->model->createCategoryCourse($inputData);
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
        return CategoryCourseResource::collection($result);
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

        if ($hasFile) {
            $imageName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('image/category/course/', $imageName);
            $image = 'image/category/course/' . $imageName;
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

}
