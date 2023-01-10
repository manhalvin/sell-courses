<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryCourse extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public function parent()
    {
        return $this->belongsTo(CategoryCourse::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CategoryCourse::class, 'parent_id');
    }
}
