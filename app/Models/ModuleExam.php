<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleExam extends Model
{
    protected $fillable = ['course_module_id', 'title', 'status', 'duration_minutes', 'start_date', 'end_date'];

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function module()
    {
        return $this->belongsTo(CourseModule::class, 'course_module_id');
    }

    public function attempts()
    {
        return $this->hasMany(ExamAttempt::class, 'module_exam_id');
    }
}
