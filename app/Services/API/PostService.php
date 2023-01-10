<?php
namespace App\Services\API;

use App\Http\Resources\API\PostResource;
use App\Repositories\Eloquent\API\PostRepository;
use Illuminate\Support\Facades\File;
use Laravolt\Avatar\Avatar;

class PostService extends BaseService
{
    protected $model;
    protected $table = 'posts';

    public function __construct()
    {
        $this->model = new PostRepository;
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
            $thumbnail->move('image/post/', $imageName);
            $image = 'image/post/' . $imageName;
            $inputData['thumbnail'] = $image;
        }

        $post = $this->model->createPost($inputData);
        if (!$post) {
            throw new \Exception('Error ! Create Data Post No Success', 1);
        }
        $result = [
            'post_id' => $post->id,
        ];
        return $result;
    }

    /**
     * Xử lý lấy danh sách posts
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
        return PostResource::collection($result);
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
            $thumbnail->move('image/post/', $imageName);
            $image = 'image/post/' . $imageName;
            $data['thumbnail'] = $image;
        }

        $result = $this->model->updatePost($data, $id);
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

    public function handleUploadMultipleImagePost($images, $postId)
    {
        $imageErrors = [];
        try {

            foreach ($images as $image) {
                $name = time() . rand(1, 99) . '.' . $image->getClientOriginalExtension();
                $image->move('image/multi/posts', $name);
                $pathImage = 'image/multi/posts/' . $name;

                $data = [
                    'name' => $name,
                    'path' => $pathImage,
                    'post_id' => $postId,
                ];

                $imageErrors[] = $pathImage;
                $this->model->saveMultipleImagePost($data);
            }

        } catch (\Exception$e) {

            foreach ($imageErrors as $imageError) {
                if (File::exists(public_path($imageError))) {
                    unlink($imageError);
                }
            }
            throw new \Exception('Error ! Upload Multiple Image Post No Success', 1);

        }

    }

    /**
     * Xóa nhiều hình ảnh của post
     * @param mixed $data
     * @throws \Exception
     * @return array<string>
     */
    public function handleDeleteImageAll($data)
    {
        $postData = $this->model->verifyPostId($data['post_id']);
        if ($postData->count() <= 0) {
            throw new \Exception('Error ! No find ', 1);
        }

        foreach ($postData as $v) {
            if (File::exists(public_path($v->path))) {
                unlink($v->path);
            }
        }

        $result = $this->model->deleteImageAll($data['post_id']);
        // $success = [
        //     'message' => 'Success ! Delete Images Post Success',
        // ];
        return $result;
    }

}
