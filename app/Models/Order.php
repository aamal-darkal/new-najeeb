<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'amount',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
