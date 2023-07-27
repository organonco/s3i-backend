<?php

namespace App\Http\Requests\API\Student\Profile;

use App\Http\Requests\API\Request;
use App\Models\EducationLevel;
use App\Models\Nationality;
use Veelasky\LaravelHashId\Rules\ExistsByHash;

class NotificationsRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }
}
