<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'week_program_id',
        'subject_id',
        'name',
        'video_link',
        'date',
        'duration',
    ];

    public function pdfFiles()
    {
        return $this->hasMany(PdfFile::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot(['date','views']);
    }
    public function weekProg()
    {
        return $this->belongsTo(WeekProgram::class,'week_program_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


}
