<?php
namespace App\Services\API;

use App\Http\Resources\API\OrderResource;
use App\Repositories\Eloquent\API\CartRepository;
use App\Repositories\Eloquent\API\CouponRepository;
use App\Repositories\Eloquent\API\CourseRepository;
use App\Repositories\Eloquent\API\OrderDetailRepository;
use App\Repositories\Eloquent\API\OrderRepository;
use Illuminate\Support\Facades\Auth;

class OrderService extends BaseService
{
    protected $orderRepository;
    protected $couponRepository;
    protected $cartRepository;
    protected $courseRepository;
    protected $orderDetailRepository;
    protected $table = 'orders';

    public function __construct()
    {
        $this->orderRepository = new OrderRepository;
        $this->couponRepository = new CouponRepository;
        $this->cartRepository = new CartRepository;
        $this->courseRepository = new CourseRepository;
        $this->orderDetailRepository = new OrderDetailRepository;
    }

    /**
     * Xử lý chức năng checkout bên client
     * @param mixed $email
     * @param mixed $name
     * @param mixed $couponCode
     * @param mixed $paymentMethod
     * @throws \Exception
     * @return mixed
     */
    public function handleCheckout($email, $name, $couponCode, $paymentMethod)
    {
        $userId = Auth::user()->id;
        $infoCart = $this->infoCart();
        if ($couponCode) {

            $coupon = $this->couponRepository->getCouponList($couponCode);
            if (!$coupon) {
                throw new \Exception('Coupon wrong or coupon expired', 1);
            }

            if ($coupon->quantify <= 0) {
                throw new \Exception('The discount code is out of stock !', 1);
            }
            $coupon->quantify -= 1;
            $coupon->coupon_user = $coupon->code . ',' . Auth::id();
            $coupon->save();

            $total = $infoCart['total'];
            if ($coupon->condition == 1) {
                $totalCoupon = ($total * $coupon->time) / 100;
                $totalReduction = $total - $totalCoupon;
            } elseif ($coupon->condition == 2) {
                $totalReduction = $total - $coupon->time;
            }
        }

        $data = [
            'email' => $email,
            'name' => $name,
            'total' => $infoCart['total'],
            'num_order' => $infoCart['num_order'],
            'method_payment' => $paymentMethod,
            'total_reduction' => !empty($totalCoupon) ? $totalCoupon : 0,
            'coupon_code' => $couponCode ?? 0,
            'final_amount' => !empty($totalReduction) ? $totalReduction : $infoCart['total'],
        ];

        $orderId = $this->orderRepository->createOrder($data);
        if (!$orderId) {
            throw new \Exception('Save order fail !', 1);
        }

        $carts = $this->cartRepository->getCartByUserId($userId);
        foreach ($carts as $cart) {
            $this->orderDetailRepository->createOrderDetail($cart, $orderId);
        }

        return $carts;
    }

    /**
     * Xử lý tích hơp thanh toán VNPay = ATM
     * @return void
     */
    public function handlePayment()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/Laravel/api/client/courses/checkout/";
        $vnp_TmnCode = "UD2KZW06"; //Mã website tại VNPAY
        $vnp_HashSecret = "HUQJSLMKGFXYCNYOWXBBEYDADEGNMOBB"; //Chuỗi bí mật

        $vnp_TxnRef = 'IS-HZZZWA8'; //Mã đơn hàng.
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 50000 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        if (isset($fullName) && trim($fullName) != '') {
            $name = explode(' ', $fullName);
            $vnp_Bill_FirstName = array_shift($name);
            $vnp_Bill_LastName = array_pop($name);
        }
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_Bill_FirstName" => 'Quốc',
            "vnp_Bill_LastName" => 'Mạnh',
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
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

    /**
     * Lấy danh sách đơn hàng
     * @param mixed $userId
     * @throws \Exception
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getOrderList($userId)
    {
        $result = $this->orderRepository->getOrderList($userId);
        if (!$result->count()) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        return OrderResource::collection($result);
    }

    /**
     * Lấy đơn hàng chi tiết
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function getById($id)
    {
        $item = $this->orderDetailRepository->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        $model = $this->orderDetailRepository->getById($id);
        return $model;
    }

    /**
     * Lấy danh sách tất cả đơn hàng
     * combo: status, search, sort
     * @param mixed $status
     * @param mixed $search
     * @param mixed $sortBy
     * @param mixed $sortType
     * @throws \Exception
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAll($status, $search, $sortBy, $sortType)
    {
        // Lọc trạng thái ẩn hiên
        $filters = [];
        if (!empty($status)) {
            if ($status == 'ordered') {
                $filters[] = [$this->table . '.status', '=', 'ordered'];
            } elseif ($status == 'processing') {
                $filters[] = [$this->table . '.status', '=', 'processing'];
            } elseif ($status == 'delivery in progress') {
                $filters[] = [$this->table . '.status', '=', 'delivery in progress'];
            } elseif ($status == 'delivered') {
                $filters[] = [$this->table . '.status', '=', 'delivered'];
            } elseif ($status == 'Cancelled') {
                $filters[] = [$this->table . '.status', '=', 'cancelled'];
            } elseif ($status == 'lie') {
                $filters[] = [$this->table . '.status', '=', 'lie'];
            } elseif ($status == 'wait for pay') {
                $filters[] = [$this->table . '.status', '=', 'wait for pay'];
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

        $result = $this->orderRepository->getList($status, $filters, $search, $sortArr, config('services.PER_PAGE'));
        if (!$result->count()) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        return OrderResource::collection($result);
    }

    /**
     * Lấy số lượng bản ghi kích hoạt
     * @return mixed
     */
    public function countRecordActive()
    {
        return $this->orderRepository->countRecordActive();
    }

    /**
     * Lấy số lượng bản ghi đã bị xóa mềm
     * @return int|mixed
     */
    public function countRecordTrash()
    {
        return $this->orderRepository->countRecordTrash();
    }

    /**
     * Xử lý cập nhật trạng thái đơn hàng
     * @param mixed $data
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function handleUpdateData($data, $id)
    {
        $item = $this->orderRepository->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Not find record', 1);
        }

        $result = $this->orderRepository->updateOrder($data, $id);
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
        $item = $this->orderRepository->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Not find record', 1);
        }

        $result = $this->orderRepository->deleteData($id);
        if (!$result) {
            throw new \Exception('Error ! Delete Data No Success', 1);
        }

        return $result;
    }
    /**
     * Xử lý hành động : xóa tạm thời, xóa vĩnh viễn, khôi phục bản ghi
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

            $item = $this->orderRepository->checkManyRecordExist($listCheck);
            if (!$item) {
                throw new \Exception('Record no exist', 1);
            }

            $this->orderRepository->destroyData($listCheck);
            return 'You have successfully deleted the temporary record';

        } elseif ($action == 'active') {
            $this->orderRepository->restoreData($listCheck);
            return 'You have successfully restored the record';

        } elseif ($action == 'forceDelete') {
            $this->orderRepository->forceDelete($listCheck);
            return 'You have successfully restored the record';

        } elseif ($action == 'public') {
            $this->orderRepository->approveRecord($listCheck);
            return 'You have successfully made the record public';

        } else {
            $this->orderRepository->incognitoRecord($listCheck);
            return 'You have successfully converted the record to pending approval';
        }
    }

}
