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
        Schema::table('course_quiz_questions', function(Blueprint $table){
            $table->text('text')->change();
        });
        Schema::table('course_quizzes', function(Blueprint $table){
            $table->text('name')->change();
        });
        Schema::table('course_quiz_question_options', function(Blueprint $table){
            $table->text('text')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_quiz_questions', function(Blueprint $table){
            $table->string('text')->change();
        });
        Schema::table('course_quizzes', function(Blueprint $table){
            $table->string('name')->change();
        });
        Schema::table('course_quiz_question_options', function(Blueprint $table){
            $table->string('text')->change();
        });
    }
};
