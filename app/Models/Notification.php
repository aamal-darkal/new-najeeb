<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'time_publish',
        'created_at'
    ];
    public $timestamps = false ;
    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot(['seen']);
    }
}
