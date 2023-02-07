<?php
namespace App\Repositories\Eloquent\API;

use App\Models\FailedLogin;
use Illuminate\Support\Carbon;

class FailedLoginRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new FailedLogin();
    }

    public function getById()
    {
        return $this->model->where('ip', request()->ip())->first();
    }

    public function saveFailedLogin($ip)
    {
        $result = $this->model->where('ip', $ip)->first();

        if (!$result) {
            $this->model->ip = $ip;
            $this->model->attempts = 1;
            return $this->model->save();
        } else {
            $result->attempts += 1;
            return $result->save();
        }
    }

    public function update($ip)
    {
        return $this->model->where('ip', $ip)->first()
            ->update([
            'ip' => $ip,
            'attempts' => 0,
            'time' => null
        ]);
    }

}
