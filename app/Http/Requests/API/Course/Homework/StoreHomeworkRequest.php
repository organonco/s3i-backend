<?php

namespace App\Http\Requests\API\Course\Homework;

use App\Http\Requests\API\Request;
use Illuminate\Validation\Rules\File;

/**
 * @urlParam id string required
 */
class StoreHomeworkRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => File::types(['pdf', 'jpeg', 'jpg', 'png'])
                ->max(20 * 1024),
        ];
    }
}
