<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleAssignment extends Model
{
    protected $fillable = ['course_module_id', 'title', 'description', 'file_path', 'original_name', 'due_date', 'start_date', 'end_date'];

    public function module()
    {
        return $this->belongsTo(CourseModule::class, 'course_module_id');
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class, 'module_assignment_id');
    }
}
