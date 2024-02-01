<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'name',
        'cost',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
