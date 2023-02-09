<?php
namespace App\Services\API;

use App\Http\Resources\API\OrderResource;
use App\Repositories\Eloquent\API\CartRepository;
use App\Repositories\Eloquent\API\CouponRepository;
use App\Repositories\Eloquent\API\CourseRepository;
use App\Repositories\Eloquent\API\OrderDetailRepository;
use App\Repositories\Eloquent\API\OrderRepository;
use App\Repositories\Eloquent\API\PaymentRepository;
use Illuminate\Support\Facades\Auth;

class OrderService extends BaseService
{
    protected $orderRepository;
    protected $couponRepository;
    protected $cartRepository;
    protected $courseRepository;
    protected $orderDetailRepository;
    protected $paymentRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository;
        $this->couponRepository = new CouponRepository;
        $this->cartRepository = new CartRepository;
        $this->courseRepository = new CourseRepository;
        $this->orderDetailRepository = new OrderDetailRepository;
        $this->paymentRepository = new PaymentRepository;
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
    public function handleCheckout($email, $name, $couponCode, $paymentMethod, $userId)
    {
        $infoCart = $this->infoCart($userId);
        if ($couponCode) {

            $coupon = $this->couponRepository->getCouponList($couponCode);
            if (!$coupon) {
                throw new \Exception('Coupon wrong or coupon expired', 1);
            }

            if ($coupon->quantify <= 0) {
                throw new \Exception('The discount code is out of stock !', 1);
            }
            $coupon->quantify -= 1;
            $coupon->coupon_user = $coupon->code . ',' . $userId;
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

        return [
            'order_id' => $orderId,
        ];
    }

    /**
     * Xử lý tích hơp thanh toán VNPay = ATM
     * @return void
     */
    public function handlePayment($orderId)
    {
        $order = $this->orderRepository->getById($orderId);
        $result = VnPayment($order);
        return $result;
    }

    /**
     * Xử lý chức năng hoàn tất thanh toán
     * @param mixed $inputData
     * @throws \Exception
     * @return void
     */
    public function handleCompleteCheckout($inputData)
    {
        $order = $this->orderRepository->checkExistByOrderCode($inputData['vnp_TxnRef']);
        if (!$order) {
            throw new \Exception('Order does not exist', 1);
        }

        $return = $this->paymentRepository->checkOrderExistByPayment($inputData['vnp_OrderInfo']);
        if($return){
            throw new \Exception('The order already exists in the payment', 1);
        }

        $payment = $this->paymentRepository->createPayment($inputData);
        $this->orderRepository->updateOrder($inputData['vnp_OrderInfo'], $inputData);

        if (!$payment) {
            throw new \Exception('Create payment fail', 1);
        }

        return $payment;
    }

    /**
     * Xử lý tính toán
     * Hiển thi tổng tiền và tổng số lương khóa hoc đã đăt trong cart
     * nhưng chưa thanh toán
     * @return array
     */
    public function infoCart($userId)
    {
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

        $result = $this->orderDetailRepository->getById($id);
        return $result;
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
        // Lọc trạng thái đơn hàng
        $filters = [];
        $table = 'orders';

        if (!empty($status)) {
            if ($status == 'ordered') {
                $filters[] = [$table . '.status', '=', 'ordered'];
            } elseif ($status == 'processing') {
                $filters[] = [$table . '.status', '=', 'processing'];
            } elseif ($status == 'delivery in progress') {
                $filters[] = [$table . '.status', '=', 'delivery in progress'];
            } elseif ($status == 'delivered') {
                $filters[] = [$table . '.status', '=', 'delivered'];
            } elseif ($status == 'cancelled') {
                $filters[] = [$table . '.status', '=', 'cancelled'];
            } elseif ($status == 'completed') {
                $filters[] = [$table . '.status', '=', 'completed'];
            } elseif ($status == 'wait for pay') {
                $filters[] = [$table . '.status', '=', 'wait for pay'];
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
    public function handleUpdateData($orderId, $data)
    {
        $item = $this->orderRepository->checkRecordExist($orderId);
        if (!$item) {
            throw new \Exception('Error ! Not find record', 1);
        }

        $result = $this->orderRepository->updateOrder($orderId, $data);
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
