<?php

namespace App\Models;

use App\Enums\CourseQuizQuestionTypes;
use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseQuizQuestion extends BaseModel
{
    protected $fillable = ['text', 'type', 'order', 'course_quiz_id'];
    protected $with = ['options'];

    public static function createOrUpdateFromDataObject($dataObject, $order, $quizId)
    {
        if (isset($dataObject['id'])) {
            $question = static::byHash($dataObject['id']);
            $question->update(array_merge($dataObject['object'], ['order' => $order]));
        } else {
            $question = self::create(array_merge($dataObject['object'], ['order' => $order, 'course_quiz_id' => $quizId]));
            if (isset($dataObject['object']['options']))
                foreach ($dataObject['object']['options'] as $index => $option)
                    $question->options()->create(array_merge(['order' => $index], $option['object']));
        }
        return $question;
    }

    public function options(): HasMany
    {
        return $this->hasMany(CourseQuizQuestionOption::class);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(CourseQuiz::class, 'course_quiz_id');
    }

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => CourseQuizQuestionTypes::from($value),
            set: fn($value) => $value,
        );
    }
}
