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
            'id' => $this->hash,
            'expires_at' => date('d/m/Y', strtotime($this->expires_at)),
            'courses' => SelectResource::collection($this->courses),
            'tags' => $this->tags->pluck('name'),
            'tokens' => TokenResource::collection($this->tokens),
            'number_of_tokens' => $this->tokens->count(),
            'number_of_used_tokens' => $this->tokens->whereNotNull('student_id')->count()
        ];
    }
}
