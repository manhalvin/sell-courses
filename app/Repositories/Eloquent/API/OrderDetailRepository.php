<?php
namespace App\Repositories\Eloquent\API;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderDetailRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new OrderDetail;
    }

    /**
     * Tạo đơn hàng chi tiết
     * @param mixed $data
     * @param mixed $orderId
     * @return void
     */
    public function createOrderDetail($data, $orderId)
    {
        $this->model->create([
            'name' => $data->title,
            'price' => $data->price,
            'quantify' => $data->qty,
            'thumbnail' => $data->thumbnail,
            'sub_total' => $data->price,
            'user_created' => Auth::user()->name,
            'order_id' => $orderId,
            'course_id' => $data->course_id
        ]);
    }

    /**
     * Kiển tra bản ghi có tồn tại trong database ?
     * @param mixed $id
     * @return mixed
     */
    public function checkRecordExist($id)
    {
        return $this->model->where('order_id', $id)->exists();
    }

    /**
     * Lấy đơn hàng chi tiết theo id của order
     * @param mixed $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->where('order_id', $id)->get();
    }

}
