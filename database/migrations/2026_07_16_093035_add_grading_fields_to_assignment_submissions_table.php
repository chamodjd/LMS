// database/migrations/2026_07_16_000000_add_grading_fields_to_assignment_submissions_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('assignment_submissions', function (Blueprint $table) {
            $table->boolean('checked')->default(false)->after('feedback');
            $table->timestamp('checked_at')->nullable()->after('checked');
            $table->boolean('published')->default(false)->after('checked_at');
            $table->timestamp('published_at')->nullable()->after('published');
        });
    }

    public function down()
    {
        Schema::table('assignment_submissions', function (Blueprint $table) {
            $table->dropColumn(['checked', 'checked_at', 'published', 'published_at']);
        });
    }
};
