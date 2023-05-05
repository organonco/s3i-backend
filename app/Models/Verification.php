<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Verification extends BaseModel
{
    protected $fillable = ['student_id', 'code'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function markAsVerified()
    {
        $this->is_verified = true;
        $this->save();
        $this->student->markAsVerified();
    }
}
