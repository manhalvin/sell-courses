<?php

namespace App\Http\Resources\API;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'slug' => $this->slug,
            'thumbnail' => Str::limit($this->thumbnail, 10),
            'price' => $this->price,
            'category_course' => !empty($this->categoryCourse->name) ? $this->categoryCourse->name : 0 ,
            'status' => $this->status == 1 ? "Show" : "Hidden",
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
