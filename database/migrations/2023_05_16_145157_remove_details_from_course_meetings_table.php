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
        Schema::table('course_meetings', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('time');
            $table->dropColumn('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_meetings', function (Blueprint $table) {
            $table->text('url');
            $table->time('time');
            $table->date('date');
        });
    }
};
