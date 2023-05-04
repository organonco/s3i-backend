<?php

namespace App\Http\Resources\Dashboard\Show\Course\Token;

use App\Http\Resources\Base\Course\Token\TokenBatchResource;
use App\Http\Resources\Dashboard\Index\Course\Token\TokenDashboardIndexResource;
use Illuminate\Http\Request;

class TokenBatchDashboardShowResource extends TokenBatchResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['tokens'] = TokenDashboardIndexResource::collection($this->tokens);
        $base['tags'] = $base['tags']->pluck('name');
        return $base;
    }
}
