<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'emp_no',
        'name',
        'mobile_no',
        'hire_date',
        'salary',
        'department',
        'qualification',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
