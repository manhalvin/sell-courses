<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'order_code' => $this->order_code,
            'total_quantify' => $this->total_quantify,
            'payment_method' => $this->payment_method,
            'order_date' => $this->order_date,
            'original_amount' => $this->currency_format($this->original_amount),
            'discount_amount' => !empty($this->discount_amount) ? $this->currency_format($this->discount_amount) : 0,
            'coupon_code' => $this->coupon_code,
            'final_amount' => $this->currency_format($this->final_amount),
            'user_id' => Auth::user()->name,
            'status' => $this->status,
            'user_created' => $this->user_created,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }

    public function currency_format($number, $suffix = 'đ') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
}
