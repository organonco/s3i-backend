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
        Schema::create('course_quiz_question_options', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->tinyInteger('order');
            $table->boolean('is_correct')->default(false);
            $table->foreignId('course_quiz_question_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_quiz_question_options');
    }
};
