<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    protected $fillable = ['course_id', 'title', 'description', 'order', 'instructor_id', 'module_code'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function files()
    {
        return $this->hasMany(ModuleFile::class);
    }

    public function topics()
    {
        return $this->hasMany(ModuleTopic::class)->orderBy('order');
    }

    public function assignments()
    {
        return $this->hasMany(ModuleAssignment::class);
    }

    public function exams()
    {
        return $this->hasMany(ModuleExam::class);
    }
}
