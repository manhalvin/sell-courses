<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseEpisode extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['video'];
    // protected $fillable = ['title','content',''];

    protected $table = 'course_episodes';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
