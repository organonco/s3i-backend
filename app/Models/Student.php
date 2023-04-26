<?php

namespace App\Models;

use App\Models\BaseModels\BaseUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Student extends BaseUser
{
    use HasApiTokens;

    public $fillable = ['phone', 'password', 'name_ar', 'name_en', 'email', 'date_of_birth', 'nationality_id', 'education_level_id', 'address', 'reference'];

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

    public function resetNumberOfLoginAttempts()
    {
        $this->number_of_login_attempts = 0;
        $this->save();
    }

    public function canLogin(): int
    {
        return $this->number_of_login_attempts < 3;
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
}
