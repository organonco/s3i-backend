<?php

namespace App\Http\Resources\Base\Course\Token;

use App\Http\Resources\Base\SelectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenBatchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->hash,
            'expires_at' => date('d/m/Y', strtotime($this->expires_at)),
            'tags' => SelectResource::collection($this->whenLoaded('tags')),
            'courses' => SelectResource::collection($this->whenLoaded('courses')),
            'number_of_tokens' => $this->tokens()->count(),
            'number_of_used_tokens' => $this->tokens()->whereNotNull('student_id')->count()
        ];
    }
}
