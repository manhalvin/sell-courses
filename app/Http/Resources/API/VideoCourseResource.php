<?php

namespace App\Http\Resources\API;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoCourseResource extends JsonResource
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
            'link_video' => Str::limit($this->link_video, 10),
            'episodes' => $this->episodes,
            'course' => $this->course_id,
            'status' => $this->status == 1 ? "Show" : "Hidden",
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
