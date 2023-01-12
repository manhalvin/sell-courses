<?php
namespace App\Services\API;

use App\Repositories\Eloquent\API\CouponRepository;
use App\Repositories\Eloquent\API\OrderDetailRepository;
use App\Repositories\Eloquent\API\OrderRepository;

class OrderService extends BaseService
{
    protected $model;
    protected $orderRepository;
    protected $couponRepository;
    protected $table = 'order_details';

    public function __construct()
    {
        $this->model = new OrderDetailRepository;
        $this->orderRepository = new OrderRepository;
        $this->couponRepository = new CouponRepository;
    }

    

}
