<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            }
            if (!Schema::hasColumn('students', 'address')) {
                $table->string('address')->nullable();
            }
            if (!Schema::hasColumn('students', 'dob')) {
                $table->date('dob')->nullable();
            }
            if (!Schema::hasColumn('students', 'degree')) {
                $table->string('degree')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'address', 'dob', 'degree']);
        });
    }
};
