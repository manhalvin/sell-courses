<?php
namespace App\Repositories\Eloquent\API;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Cart();
    }

    public function createOrderDetail($data, $orderId)
    {
        $this->model->create([
            'name' => $data['name'],
            'price' => $data['price'],
            'quantify' => $data['qty'],
            'thumbnail' => $data['thumbnail'],
            'sub_total' => $data['sub_total'],
            'user_created' => Auth::user()->name,
            'order_id' => $orderId,
            'course_id' => $data['id'],
        ]);
    }

    public function getCart($productId, $userId)
    {
        return $this->model->where('course_id', $productId)->where('user_id', $userId)->first();
    }

    public function deleteCourse($id, $userId)
    {
        return $this->model->where('course_id', $id)
            ->where('user_id', $userId)
            ->delete();
    }

    public function getCartByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }

    public function createCart($data)
    {
        return $this->model->create($data);
    }

}
