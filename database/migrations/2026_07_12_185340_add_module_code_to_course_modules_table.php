<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('course_modules', function (Blueprint $table) {
            $table->string('module_code')->nullable()->after('title');
        });
    }

    public function down()
    {
        Schema::table('course_modules', function (Blueprint $table) {
            $table->dropColumn('module_code');
        });
    }
};
