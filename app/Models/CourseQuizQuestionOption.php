<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseQuizQuestionOption extends BaseModel
{
    protected $fillable = ['order', 'text', 'is_correct', 'course_quiz_question_id'];

    public static function createOrUpdateFromDataObject($dataObject, $question_id, $index)
    {
        if(!isset($dataObject['id']))
            self::create(array_merge(['order' => $index, 'course_quiz_question_id' => $question_id], $dataObject['object']));
        else {
            $option = self::byHash($dataObject['id']);
            $option->update([
                'text' => $dataObject['object']['text'],
                'is_correct' => $dataObject['object']['is_correct'],
            ]);
        }
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(CourseQuizQuestion::class, 'course_quiz_question_id');
    }
}
