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
        'color',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }
    public function weekProgs()
    {
        return $this->hasMany(WeekProgram::class);
    }
    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
