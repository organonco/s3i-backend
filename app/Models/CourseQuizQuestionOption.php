<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseQuizQuestionOption extends BaseModel
{
    protected $fillable = ['text', 'is_correct', 'course_quiz_question_id'];
    public function question() : BelongsTo
    {
        return $this->belongsTo(CourseQuizQuestion::class, 'course_quiz_question_id');
    }
}
