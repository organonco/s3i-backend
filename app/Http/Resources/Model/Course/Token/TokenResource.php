<?php

namespace App\Http\Resources\Model\Course\Token;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->uuid,
            'student' => $this->student ? $this->student->name : 'Not Used',
        ];
    }
}
