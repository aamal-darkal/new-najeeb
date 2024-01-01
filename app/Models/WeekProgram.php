<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeekProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'day',
        'start_time',
        'end_time',
    ];
    public $timestamps = false ;

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function lecture()
    {
        return $this->hasMany(Lecture::class);
    }
}
