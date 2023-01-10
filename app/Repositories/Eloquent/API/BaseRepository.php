<?php
namespace App\Repositories\Eloquent\API;

use App\Models\CategoryCourse;

class BaseRepository
{
    protected $categoryCourse;

    public function __construct()
    {
        $this->categoryCourse = new CategoryCourse;
    }
}
