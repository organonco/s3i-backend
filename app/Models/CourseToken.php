<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CourseToken extends BaseModel
{
    protected $fillable = ['course_token_batch_id'];

    public function batch(): BelongsTo
    {
        return $this->belongsTo(CourseTokenBatch::class, 'course_token_batch_id');
    }

    public function course(): BelongsTo
    {
        return $this->batch->course();
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function isUsed()
    {
        return !is_null($this->student()->first());
    }

    public function setStudent(Student $student) : void
    {
        $this->student()->associate($student);
        $this->save();

        /** @var Course $course */
        foreach($this->batch->courses as $course)
        {
            $course->addStudent($student);
        }
    }
}
