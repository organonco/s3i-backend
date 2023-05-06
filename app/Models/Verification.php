<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Carbon\Carbon;
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

    public function getIsExpiredAttribute() : bool
    {
        return Carbon::parse($this->created_at)->addSeconds(config('verification.phone_verification_expires_in'))->isPast();
    }
}
