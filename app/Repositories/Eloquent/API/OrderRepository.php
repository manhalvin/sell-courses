<?php
namespace App\Repositories\Eloquent\API;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Order;
    }

    /**
     * Tạo đơn hàng
     * @param mixed $data
     * @return mixed
     */
    public function createOrder($data)
    {
        $orderCode = 'IS-' . $this->createOrderId();
        $orderId = $this->model->insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'order_code' => $orderCode,
            'total_quantify' => $data['num_order'],
            'payment_method' => $data['method_payment'],
            'order_date' => Carbon::now('Asia/Ho_Chi_Minh'),
            'original_amount' => $data['total'],
            'discount_amount' => $data['total_reduction'],
            'coupon_code' => $data['coupon_code'],
            'final_amount' => $data['final_amount'],
            'user_id' => Auth::id(),
            'status' => 'wait for pay',
            'user_created' => Auth::user()->name,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);

        return $orderId;
    }

    /**
     * Tạo mã đơn hàng
     * @return string
     */
    public function createOrderId() {
        do {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $string = '';
            $max = strlen($characters) - 1;
            for ($i = 0; $i < 8; $i++) {
                $string .= $characters[mt_rand(0, $max)];
            }
        } while ($this->model->where('id', 'like', "%IS-{$string}%")->first());
        return $string;
    }

    /**
     *  Lấy thông tin đơn hàng theo email
     * @param mixed $email
     * @return mixed
     */
    public function getOrderByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Lấy danh sách đơn hàng theo id của user
     * @param mixed $userId
     * @return mixed
     */
    public function getOrderList($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }

    /**
     * Kiểm tra bản ghi có tồn tại trong database ?
     * @param mixed $id
     * @return mixed
     */
    public function checkRecordExist($id)
    {
        return $this->model->where('id', $id)->exists();
    }

    /**
     * Lấy thông tin chi tiết của đơn hàng
     * @param mixed $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Lấy danh sách của đơn hàng
     * combo: status + filter + search + sort + pagination
     * @param mixed $status
     * @param mixed $filters
     * @param mixed $search
     * @param mixed $sortArr
     * @param mixed $perPage
     * @return mixed
     */
    public function getList($status, $filters = [], $search = null, $sortArr = null, $perPage = null)
    {
        $query = $this->model->select('*');

        if ($status == 'trash') {
            $query->onlyTrashed()->latest();
        }

        $orderBy = 'created_at';
        $orderType = 'desc';

        if (!empty($sortArr) && is_array($sortArr)) {
            if (!empty($sortArr['sortBy']) && !empty($sortArr['sortType'])) {
                $orderBy = trim($sortArr['sortBy']);
                $orderType = trim($sortArr['sortType']);
            }
        }

        if (!empty($filters)) {
            $query = $query->where($filters);
        }

        if (!empty($search)) {
            $query = $query->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%{$search}%");
                $query->orWhere('email', 'like', "%{$search}%");
                $query->orWhere('order_code', 'like', "%{$search}%");
            });
        }

        return !empty($perPage)
        ? $query->orderBy($orderBy, $orderType)->paginate($perPage)
        : $query->orderBy($orderBy, $orderType)->get();
    }

    /**
     * Lấy số lượng bản ghi kích hoạt
     * @return mixed
     */
    public function countRecordActive()
    {
        return $this->model->count();
    }

    /**
     * Lấy số lượng bản ghi đã bị xóa mền
     * @return int|mixed
     */
    public function countRecordTrash()
    {
        return $this->model->onlyTrashed()->count();
    }


    /**
     * Cập nhật trạng thái đơn hàng
     * @param mixed $data
     * @param mixed $id
     * @return mixed
     */
    public function updateOrder($data, $id)
    {
        return $this->model->find($id)
            ->update(['status' => $data['status']]);
    }

    /**
     * Xóa tạm thời đơn hàng
     * @param mixed $id
     * @return mixed
     */
    public function deleteData($id)
    {
        $this->model->find($id)->update([
            'user_deleted' => Auth::user()->name,
        ]);
        return $this->model->find($id)
            ->delete();
    }

    /**
     * Xóa hàng loạt đơn hàng (trạng thái tạm thời)
     * @param mixed $listCheck
     * @return int
     */
    public function destroyData($listCheck)
    {
        $this->model->WhereIn('id', $listCheck)->update([
            'user_deleted' => Auth::user()->name,
        ]);
        return $this->model->destroy($listCheck);
    }

    /**
     * Khôi phục bản ghi đã bị xóa mềm
     * @param mixed $listCheck
     * @return mixed
     */
    public function restoreData($listCheck)
    {
        return $this->model->onlyTrashed()->whereIn('id', $listCheck)->restore();
    }

    /**
     * Xóa vĩnh viễn bản ghi
     * @param mixed $listCheck
     * @return mixed
     */
    public function forceDelete($listCheck)
    {
        return $this->model->onlyTrashed()->whereIn('id', $listCheck)->forceDelete();
    }

    /**
     * Cập nhật trạng thái đơn hàng từ ẩn sang hiện
     * @param mixed $listCheck
     * @return mixed
     */
    public function approveRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 1,
        ]);
    }

    /**
     * Cập nhật trạng thái đơn hàng từ hiện sang ẩn
     * @param mixed $listCheck
     * @return mixed
     */
    public function incognitoRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 0,
        ]);
    }

    /**
     * Kiểm tra nhiều bản ghi có tồn tại trong database ?
     * @param mixed $listCheck
     * @return mixed
     */
    public function checkManyRecordExist($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->exists();
    }
}
