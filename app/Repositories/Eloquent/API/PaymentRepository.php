<?php
namespace App\Repositories\Eloquent\API;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Payment;
    }

    /**
     * Tạo payment
     * @param mixed $data
     * @param mixed $orderId
     * @return void
     */
    public function createPayment($data)
    {
        return $this->model->create([
            'vnp_Amount' => $data['vnp_Amount'],
            'order_id' =>  $data['vnp_OrderInfo'],
            'vnp_BankCode' => $data['vnp_BankCode'],
            'vnp_BankTranNo' => $data['vnp_BankTranNo'],
            'vnp_CardType' => $data['vnp_CardType'],
            'vnp_OrderInfo' => $data['vnp_OrderInfo'],
            'vnp_PayDate' => $data['vnp_PayDate'],
            'vnp_ResponseCode' => $data['vnp_ResponseCode'],
            'vnp_TmnCode' => $data['vnp_TmnCode'],
            'vnp_TransactionNo' => $data['vnp_TransactionNo'],
            'vnp_TransactionStatus' => $data['vnp_TransactionStatus'],
            'vnp_TxnRef' => $data['vnp_TxnRef'],
            'vnp_SecureHash' => $data['vnp_SecureHash'],
        ]);
    }

    /**
     * Kiểm tra id order tồn tại trong bảng payment chưa ?
     * @param mixed $orderId
     * @return mixed
     */
    public function checkOrderExistByPayment($orderId)
    {
        return $this->model->where('order_id', $orderId)->first();
    }

}
