<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('emp_no')->unique();
            $table->string('name');
            $table->string('mobile_no');
            $table->date('hire_date');
            $table->decimal('salary', 10, 2);
            $table->string('department');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
