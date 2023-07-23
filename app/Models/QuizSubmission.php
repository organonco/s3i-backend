<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;

class QuizSubmission extends BaseModel
{

    protected $fillable = ['student_id', 'quiz_id', 'feedback'];
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

    public function scopeStudents($query, $student_ids)
    {
        return $query->whereIn('student_id', $student_ids);
    }

    public function scopeQuizzes($query, $quiz_ids)
    {
        return $query->whereIn('quiz_id', $quiz_ids);
    }

    public function getHasFeedbackAttribute()
    {
        return !is_null($this->feedback);
    }

    public function quizQuestionSubmissions()
    {
        return $this->hasMany(QuizQuestionSubmission::class);
    }

}
