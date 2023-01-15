<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\API\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\OrderResource;
use App\Http\Requests\API\Order\OrderRequest;
use App\Http\Requests\API\Order\UpdateOrderRequest;

class OrderController extends BaseController
{

    protected $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService;
    }

    /**
     * Hiển thị danh sách order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $search = "";
        $status = $request->input('status');
        $listAction = [
            'delete' => 'Xóa tạm thời'
        ];
        if($status == 'trash'){
            $listAction = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
        }

        if (!empty($request->search)) {
            $search = $request->search;
        }
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');

        try {
            $result = $this->orderService->getAll($status, $search, $sortBy, $sortType);
            $countActive = $this->orderService->countRecordActive();
            $countTrash = $this->orderService->countRecordTrash();
            $success = [
                'order' => $result,
                'count_active' => $countActive,
                'count_trash' => $countTrash,
                'list_action' => $listAction
            ];
            return $this->sendResponse($success, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     *  Hiển thị thông tin chi tiết order
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $result = $this->orderService->getById($id);
            // $result = new OrderResource($result);
            return $this->sendResponse($result, 'Success ! Fetch data success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Cập nhật trạng thái đơn hàng
     * @param OrderRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OrderRequest $request, $id)
    {
        $data = $request->all();

        try {
            $this->orderService->handleUpdateData($data, $id);
            return $this->sendResponse([], 'Update Status Order Success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Xóa mền đơn hàng
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->orderService->handleDeleteData($id);
            return $this->sendResponse([], 'Delete Data Success !');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Thực hiện các hành động như: xóa tạm thời, xóa vĩnh viễn
     * khôi phục hàng loạt bản ghi
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function action(Request $request)
    {
        $listCheck = $request->input('list_check');
        $action = $request->input('action');

        try {
            $result = $this->orderService->handleDataAction($listCheck, $action);
            return $this->sendResponse([], $result);
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }
}
