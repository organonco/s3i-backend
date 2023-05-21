<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;

class QuizQuestionSubmission extends BaseModel
{
    protected $fillable = ['course_quiz_question_id', 'quiz_submission_id', 'answer'];
    public function courseQuizQuestion()
    {
        return $this->belongsTo(CourseQuizQuestion::class);
    }

    public function QuizSubmission()
    {
        return $this->belongsTo(QuizSubmission::class);
    }
}
