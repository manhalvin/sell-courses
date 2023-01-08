<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerificationCode extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'otp', 'email', 'expire_at'];
}
