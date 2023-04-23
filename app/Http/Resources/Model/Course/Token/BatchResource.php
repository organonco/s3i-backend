<?php

namespace App\Http\Resources\Model\Course\Token;

use App\Http\Resources\SelectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BatchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'expires_at' => date('d/m/Y H:i', strtotime($this->expires_at)),
            'courses' => SelectResource::collection($this->courses),
            'tokens' => TokenResource::collection($this->tokens)
        ];
    }
}
