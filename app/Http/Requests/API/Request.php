<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
class Request extends FormRequest
{
    public function authorize() : bool
    {
        return false;
    }
    public function bodyParameters() : array
    {
        return [];
    }
}
