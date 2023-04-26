<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CourseToken extends BaseModel
{
    protected $fillable = ['course_token_batch_id'];

    public function batch(): HasOne
    {
        return $this->hasOne(CourseTokenBatch::class);
    }

    public function course(): BelongsTo
    {
        return $this->batch->course();
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
