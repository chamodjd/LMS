<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no');
            $table->string('name');
            $table->string('address');
            $table->date('dob');
            $table->integer('age');
            $table->decimal('weight', 5, 2);
            $table->timestamps();
        });
    }
}
