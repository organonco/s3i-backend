<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;

class QuizSubmission extends BaseModel
{

    protected $fillable = ['student_id', 'quiz_id'];
    protected $appends = ['quiz_hash'];

    public function courseQuiz()
    {
        return $this->belongsTo(CourseQuiz::class, 'quiz_id');
    }

    public function getQuizHashAttribute()
    {
        return $this->courseQuiz->hash;
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public static function findForStudentAndQuiz($studentId, $quizId)
    {
        return self::query()->where('student_id', $studentId)->where('quiz_id', $quizId)->first();
    }
}
