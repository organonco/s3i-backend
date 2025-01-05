<?php

namespace App\Models;

use Alhelwany\LaravelMtn\Interfaces\MTNNotifiable;
use App\Models\BaseModels\BaseUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Student extends BaseUser implements MTNNotifiable
{
    use HasApiTokens, Notifiable;

    public $fillable = ['phone', 'password', 'name_ar', 'name_en', 'email', 'date_of_birth', 'nationality_id', 'education_level_id', 'address', 'reference', 'phone_verified_at', 'gender'];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function incrementNumberOfLoginAttempts()
    {
        $this->number_of_login_attempts = $this->number_of_login_attempts + 1;
        $this->save();
    }

    public function resetNumberOfLoginAttempts($attempts)
    {
        if($this->number_of_login_attempts == $attempts)
            $this->number_of_login_attempts = 0;
        else
            $this->number_of_login_attempts = $attempts;
        $this->save();
    }

    public function resetPassword($password)
    {
        $this->update(['password' => $password]);
    }

    public function canLogin(): int
    {
        return $this->number_of_login_attempts < 6;
    }

    public function getCoursesAttribute()
    {
        return $this->classrooms()->with('course')->get()->whereNotNull('course')->pluck('course');
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value,
            set: fn(string $value) => Hash::make($value),
        );
    }

    public function verifications() : HasMany
    {
        return $this->hasMany(Verification::class);
    }

    public function getIsVerifiedAttribute()
    {
        return !is_null($this->phone_verified_at);
    }

    public function markAsVerified()
    {
        $this->phone_verified_at = Carbon::now();
        $this->save();
    }

    public function getFullPhoneNumberAttribute()
    {
        return '+963' . $this->phone;
    }

	public function getPhone() : string
	{
		return "09" . $this->phone;
	}

	public function passwordResetTokens() : HasMany
    {
        return $this->hasMany(PasswordResetToken::class);
    }
}
