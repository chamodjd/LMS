<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleTopic extends Model
{
    protected $fillable = ['course_module_id', 'title', 'description', 'file_path', 'original_name', 'order'];
}
