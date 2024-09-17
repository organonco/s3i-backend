<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasswordResetToken extends BaseModel
{
    protected $fillable = ['student_id', 'code'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function markAsUsed()
    {
        $this->is_used = true;
        $this->save();
    }

    public function getIsExpiredAttribute() : bool
    {
        return Carbon::parse($this->created_at)->addMinutes(config('verification.phone_verification_expires_in'))->isPast();
    }
}
