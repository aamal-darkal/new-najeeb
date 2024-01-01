<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'governorate',
        'phone',
        'land_line',
        'father_name',
        'gender',
        'parent_phone',
        'state',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withTimestamps();
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class)->withPivot(['date','views']);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class)->withPivot(['seen']);
    }
}
