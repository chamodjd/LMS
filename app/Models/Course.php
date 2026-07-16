<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'code', 'department', 'duration', 'price'];

    public function modules()
    {
        return $this->hasMany(CourseModule::class)->orderBy('order');
    }
}
