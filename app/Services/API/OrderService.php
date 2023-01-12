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

    public function handlePayment($email, $name, $couponCode, $paymentMethod)
    {
        $userId = Auth::user()->id;
        $infoCart = $this->infoCart();
        if ($couponCode) {
            $couponItem = $this->couponRepository->getCouponList($couponCode);
            if ($couponItem) {
                $count_coupon = $couponItem->count();
                if ($count_coupon > 0) {
                    $coupon_array = array();
                    if ($coupon_array) {
                        $is_available = 0;
                        if ($is_available == 0) {
                            $coupon[] = [
                                'coupon_code' => $couponItem->code,
                                'coupon_condition' => $couponItem->condition,
                                'coupon_number' => $couponItem->quantify,
                            ];
                        }
                    } else {
                        $coupon[] = [
                            'coupon_code' => $couponItem->code,
                            'coupon_condition' => $couponItem->condition,
                            'coupon_number' => $couponItem->quantify,
                        ];
                    }
                }

                $total = $infoCart['total'];
                foreach ($coupon as $item) {
                    if ($item['coupon_condition'] == 1) {
                        $totalCoupon = ($total * $item['coupon_number']) / 100;
                        $totalReduction = $total - $totalCoupon;
                    } elseif ($item['coupon_condition'] == 2) {
                        $totalReduction = $total - $item['coupon_number'];
                    }
                }
            } else {
                throw new \Exception(' Coupon wrong or coupon expired', 1);
            }
        }

        $data = [
            'email' => $email,
            'name' => $name,
            'total' => $infoCart['total'],
            'num_order' => $infoCart['num_order'],
            'method_payment' => $paymentMethod,
            'total_reduction' => !empty($totalCoupon) ? $totalCoupon : 0,
            'coupon_code' => !empty($couponCode) ? $couponCode : 0,
            'final_amount' => !empty($totalReduction) ? $totalReduction : $infoCart['total'],
        ];
        $orderId = $this->orderRepository->createOrder($data);
        if (!$orderId) {
            throw new \Exception('Save order fail !', 1);
        }

        $cart = $this->cartRepository->getCartByUserId($userId);
        foreach ($cart as $value) {
            $this->orderDetailRepository->createOrderDetail($value, $orderId);
        }

        return $cart;
    }

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

    public function getOrderList($userId)
    {
        $result = $this->orderRepository->getOrderList($userId);
        if (!$result->count()) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        return OrderResource::collection($result);
    }

    public function getById($id)
    {
        $item = $this->orderDetailRepository->checkRecordExist($id);
        if (!$item) {
            throw new \Exception('Error ! Fetch Data No Success', 1);
        }
        $model = $this->orderDetailRepository->getById($id);
        return $model;
    }

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

    public function countRecordActive()
    {
        return $this->orderRepository->countRecordActive();
    }

    public function countRecordTrash()
    {
        return $this->orderRepository->countRecordTrash();
    }

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
