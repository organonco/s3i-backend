<?php

namespace App\Http\Resources\Model\Course\Token;

use App\Traits\Exportable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    use Exportable;
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->hash,
            'student' => $this->student ? $this->student->name : 'Not Used',
        ];
    }
}
