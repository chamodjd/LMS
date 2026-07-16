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
        Schema::table('module_exams', function (Blueprint $table) {
            $table->enum('status', ['draft', 'published'])->default('draft')->after('title');
            $table->dateTime('start_date')->nullable()->after('duration_minutes');
            $table->dateTime('end_date')->nullable()->after('start_date');
        });
    }

    public function down()
    {
        Schema::table('module_exams', function (Blueprint $table) {
            $table->dropColumn(['status', 'start_date', 'end_date']);
        });
    }
};
