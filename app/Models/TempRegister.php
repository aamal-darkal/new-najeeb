<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempRegister extends Model
{
    use HasFactory;
    protected $fillable = [
        'mobile',
        'password',
        'first_name',
        'last_name',
        'father_name',
        'parent_phone',
        'governorate',
        'otp'
    ];
}
