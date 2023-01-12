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

    public function getOrderByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function getOrderList($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }

    public function checkRecordExist($id)
    {
        return $this->model->where('id', $id)->exists();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function createCourse($data)
    {
        $this->model->title = $data['title'];
        $this->model->content = $data['content'];
        $this->model->slug = $data['slug'];
        if ($data['thumbnail']) {
            $this->model->thumbnail = $data['thumbnail'];
        }
        $this->model->price = $data['price'];
        $this->model->category_course_id = $data['category_course_id'];
        $this->model->user_created = Auth::user()->name;
        $this->model->status = $data['status'];
        $this->model->save();
        return $this->model->fresh();
    }

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


    public function countRecordActive()
    {
        return $this->model->count();
    }

    public function countRecordTrash()
    {
        return $this->model->onlyTrashed()->count();
    }


    public function updateOrder($data, $id)
    {
        return $this->model->find($id)
            ->update(['status' => $data['status']]);
    }

    public function deleteData($id)
    {
        $this->model->find($id)->update([
            'user_deleted' => Auth::user()->name,
        ]);
        return $this->model->find($id)
            ->delete();
    }

    public function destroyData($listCheck)
    {
        $this->model->WhereIn('id', $listCheck)->update([
            'user_deleted' => Auth::user()->name,
        ]);
        return $this->model->destroy($listCheck);
    }

    public function restoreData($listCheck)
    {
        return $this->model->onlyTrashed()->whereIn('id', $listCheck)->restore();
    }

    public function forceDelete($listCheck)
    {
        return $this->model->onlyTrashed()->whereIn('id', $listCheck)->forceDelete();
    }

    public function approveRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 1,
        ]);
    }

    public function incognitoRecord($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->update([
            'status' => 0,
        ]);
    }

    public function checkManyRecordExist($listCheck)
    {
        return $this->model->whereIn('id', $listCheck)->exists();
    }
}
