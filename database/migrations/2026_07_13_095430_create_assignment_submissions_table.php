<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    protected $fillable = ['module_assignment_id', 'student_id', 'file_path', 'original_name', 'submitted_at', 'marks', 'feedback'];

    public function assignment()
    {
        return $this->belongsTo(ModuleAssignment::class, 'module_assignment_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
