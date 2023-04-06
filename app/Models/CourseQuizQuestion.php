<?php

namespace App\Models;

use App\Enums\CourseQuizQuestionTypes;
use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseQuizQuestion extends BaseModel
{
    protected $fillable = ['text', 'type', 'course_quiz_id'];
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => CourseQuizQuestionTypes::from($value),
            set: fn ($value) => $value,
        );
    }
    public function options() : HasMany
    {
        return $this->hasMany(CourseQuizQuestionOption::class);
    }
    public function quiz() : BelongsTo
    {
        return $this->belongsTo(CourseQuiz::class, 'course_quiz_id');
    }
}
