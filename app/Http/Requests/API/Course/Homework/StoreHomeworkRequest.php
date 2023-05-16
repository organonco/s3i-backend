<?php

namespace App\Http\Requests\API\Course\Homework;

use App\Http\Requests\API\Request;
use Illuminate\Validation\Rules\File;

class StoreHomeworkRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'homework_id' => 'required|string',
            'file' => 'required|file|mimes:jpeg,jpg,png,pdf',
        ];
    }

    public function getItemId()
    {
        return $this->input('homework_id');
    }
}
