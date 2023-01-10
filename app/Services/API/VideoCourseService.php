<?php
namespace App\Services\API;

use App\Http\Resources\API\VideoCourseResource;
use App\Repositories\Eloquent\API\VideoCourseRepository;
use Laravolt\Avatar\Avatar;

class VideoCourseService extends BaseService
{
    protected $model;
    protected $table = 'course_episodes';

    public function __construct()
    {
        $this->model = new VideoCourseRepository;
    }

    /**
     * Xử lý lưu dữ liệu video khóa học
     * @param mixed $inputData
     * @param mixed $thumbnail
     * @param mixed $hasFile
     * @throws \Exception
     * @return array
     */
    public function handleSaveData($inputData, $video, $hasFile, $courseId)
    {
        if (!$hasFile) {
            $avatar = new Avatar();
            $inputData['video'] = $avatar->create($inputData['title'])->toBase64();
        } else {
            $imageName = time() . '.' . $video->getClientOriginalExtension();
            $video->move('video/', $imageName);
            $image = 'video/' . $imageName;
            $inputData['video'] = $image;
        }

        $video = $this->model->createCourseVideo($inputData, $courseId);
        if (!$video) {
            throw new \Exception('Error ! Create Data No Success', 1);
        }
        $result = [
            'video_id' => $video->id,
        ];
        return $result;
    }

    /**
     * Xử lý lấy danh sách video
     * @param mixed $status
     * @param mixed $search
     * @param mixed $sortBy
     * @param mixed $sortType
     * @return void
     */
    public function getAll($status, $search, $sortBy, $sortType, $courseId)
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

        $result = $this->model->getList($status, $filters, $search, $sortArr, config('services.PER_PAGE'), $courseId);
        if (!$result->count()) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        return VideoCourseResource::collection($result);
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

    public function handleUpdateData($data, $id, $hasFile, $video)
    {
        $item = $this->model->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Not find record', 1);
        }

        $item = $this->model->getById($id);
        if ($hasFile) {
            if (file_exists($item->link_video)) {
                unlink($item->link_video);
            }
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $video->move('video/', $videoName);
            $path = 'video/' . $videoName;
            $data['link_video'] = $path;
        }

        $result = $this->model->updateVideoCourse($data, $id);
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
