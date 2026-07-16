<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    protected $fillable = [
        'module_assignment_id',
        'student_id',
        'file_path',
        'original_name',
        'submitted_at',
        'marks',
        'feedback',
        'checked',
        'checked_at',
        'published',
        'published_at',
    ];

    protected $casts = [
        'checked'      => 'boolean',
        'published'    => 'boolean',
        'submitted_at' => 'datetime',
        'checked_at'   => 'datetime',
        'published_at' => 'datetime',
    ];

    public function assignment()
    {
        return $this->belongsTo(ModuleAssignment::class, 'module_assignment_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
