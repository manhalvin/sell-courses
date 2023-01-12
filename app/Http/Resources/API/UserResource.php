<?php

namespace App\Http\Resources\API;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'gender' => !empty($this->gender) ? $this->gender : null,
            'address' => !empty($this->address) ? $this->address : null,
            'thumbnail' => Str::limit($this->thumbnail, 10),
            'status' => $this->status == 1 ? "Active" : "UnActive",
            'mobile_no' => $this->mobile_no,
            'role_id' => $this->role->name,
            'user_create' => $this->user_created,
            'activation_date' => optional($this->activation_date)->format('d/m/Y'),
            'email_verified_at' => optional($this->email_verified_at)->format('d/m/Y'),
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
