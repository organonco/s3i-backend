<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property $number_of_students
 */
class Classroom extends BaseModel
{
    protected $fillable = ['name'];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function isFull()
    {
        return $this->number_of_students >= $this->course->students_limit;
    }

    public function getNumberOfStudentsAttribute()
    {
        return $this->students()->count();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function getHomeworkSubmissionsQuery() : \Illuminate\Database\Eloquent\Builder
    {
        $homework_ids = $this->course->getHomeworks()->pluck('id');
        $student_ids = $this->students()->pluck('students.id');
        return CourseHomeworkSubmission::query()->students($student_ids)->homeworks($homework_ids);
    }

    public function getQuizSubmissionsQuery() : \Illuminate\Database\Eloquent\Builder
    {
        $quiz_ids = $this->course->getQuizzes()->pluck('id');
        $student_ids = $this->students()->pluck('students.id');
        return QuizSubmission::query()->students($student_ids)->quizzes($quiz_ids);
    }

    public function classroomMeetings(): HasMany
    {
        return $this->hasMany(ClassroomMeeting::class);
    }
}
