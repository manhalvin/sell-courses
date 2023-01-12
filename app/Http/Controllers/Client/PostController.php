<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Services\API\PostService;
use App\Http\Resources\API\PostResource;
use App\Http\Controllers\API\BaseController;

class PostController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PostService;
    }

    public function index(Request $request)
    {
        $search = "";

        if(!empty($request->search)){
            $search = $request->search;
        }

        try {
            $post = $this->model->getPostList($search);
            return $this->sendResponse($post, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    public function show($id)
    {
        try {
            $result = $this->model->getById($id);
            $result = new PostResource($result);
            return $this->sendResponse($result, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }
}
