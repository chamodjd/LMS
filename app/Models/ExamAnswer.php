<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    protected $fillable = ['exam_attempt_id', 'exam_question_id', 'selected_option', 'is_correct'];

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class);
    }
}
