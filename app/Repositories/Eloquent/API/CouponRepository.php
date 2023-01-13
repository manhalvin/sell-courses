<?php
namespace App\Repositories\Eloquent\API;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CouponRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Coupon;
    }

    /**
     * Tạo đơn hàng chi tiêt
     * @param mixed $data
     * @param mixed $orderId
     * @return void
     */
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

    /**
     * Lấy danh sách mã giảm gia (kiểm tra mã coupon hết hạn chưa ?)
     * @param mixed $couponCode
     * @return mixed
     */
    public function getCouponList($couponCode)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh');
        $coupon = Coupon::where('code', $couponCode)
            ->where('status', 1)
            ->where('date_end', '>=', $today)
            ->first();
        return $coupon;
    }

}
