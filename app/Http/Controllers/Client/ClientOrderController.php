<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Services\API\OrderService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\PaymentRequest;
use App\Http\Controllers\API\BaseController;

class ClientOrderController extends BaseController
{
    protected $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService;
    }

    /**
     * Checkout
     * @param PaymentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(PaymentRequest $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $couponCode = $request->input('coupon');
        $paymentMethod = $request->input('payment_method');

        try {
            $this->orderService->handleCheckout($email, $name, $couponCode, $paymentMethod);
            return $this->sendResponse([], 'Success ! Checkout success');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function payment()
    {
        try {
            $this->orderService->handlePayment();
            return $this->sendResponse([], 'Success ! Payment success');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Hiển thị danh sách đơn hàng
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $userId = Auth::user()->id;
        try {
            $result = $this->orderService->getOrderList($userId);
            return $this->sendResponse($result, 'Success ! fetch data success');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    /**
     * Hiển thị thông tin chi tiết đơn  hàng
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $result = $this->orderService->getById($id);
            return $this->sendResponse($result, 'Success ! fetch data success');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }
}
