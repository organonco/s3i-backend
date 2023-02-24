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
        Schema::table('students', function (Blueprint $table) {
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('email')->unique();
            $table->date('date_of_birth');
            $table->foreignId('nationality_id')->constrained();
            $table->foreignId('education_level_id')->constrained();
            $table->string('address');
            $table->text('reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('name_ar');
            $table->dropColumn('name_en');
            $table->dropColumn('email');
            $table->dropColumn('date_of_birth');
            $table->dropConstrainedForeignId('nationality_id');
            $table->dropConstrainedForeignId('education_level_id');
            $table->dropColumn('address');
            $table->dropColumn('reference');
        });
    }
};
