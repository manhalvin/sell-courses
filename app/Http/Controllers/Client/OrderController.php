<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Services\API\OrderService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\PaymentRequest;
use App\Http\Controllers\API\BaseController;

class OrderController extends BaseController
{
    protected $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService;
    }

    public function payment(PaymentRequest $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $couponCode = $request->input('coupon');
        $paymentMethod = $request->input('payment_method');

        try {;
            $this->orderService->handlePayment($email, $name, $couponCode, $paymentMethod);
            return $this->sendResponse([], 'Success ! Payment success');
        } catch (\Exception$e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

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
