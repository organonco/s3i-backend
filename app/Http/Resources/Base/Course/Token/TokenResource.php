<?php

namespace App\Http\Resources\Base\Course\Token;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'token' => $this->hash,
        ];
    }
}
