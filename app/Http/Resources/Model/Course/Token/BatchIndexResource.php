<?php

namespace App\Http\Resources\Model\Course\Token;

use App\Http\Resources\SelectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BatchIndexResource extends BatchResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['courses'] = $base['courses']->pluck('name');
        unset($base['tokens']);
        return $base;
    }
}
