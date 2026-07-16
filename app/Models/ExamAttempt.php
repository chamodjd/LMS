<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    protected $fillable = ['module_exam_id', 'student_id', 'score', 'total_questions', 'submitted_at'];

    public function exam()
    {
        return $this->belongsTo(ModuleExam::class, 'module_exam_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function answers()
    {
        return $this->hasMany(ExamAnswer::class);
    }
}
