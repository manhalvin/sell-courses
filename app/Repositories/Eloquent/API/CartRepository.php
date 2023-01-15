<?php
namespace App\Repositories\Eloquent\API;

use App\Models\Cart;

class CartRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Cart;
    }

    /**
     * Lấy thông tin giỏ hàng
     * @param mixed $productId
     * @param mixed $userId
     * @return mixed
     */
    public function getCart($productId, $userId)
    {
        return $this->model->where('course_id', $productId)
            ->where('user_id', $userId)->first();
    }

    /**
     * Xóa khóa học ra khỏi giỏ hàng
     * @param mixed $id
     * @param mixed $userId
     * @return mixed
     */
    public function deleteCourse($id, $userId)
    {
        return $this->model->where('course_id', $id)
            ->where('user_id', $userId)
            ->delete();
    }

    /**
     * Lấy thông tin giỏ hàng theo id của user
     * @param mixed $userId
     * @return mixed
     */
    public function getCartByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }

    /**
     *  Thêm khóa học vào giỏ hàng
     * @param mixed $data
     * @return mixed
     */
    public function createCart($data)
    {
        return $this->model->create($data);
    }

}
