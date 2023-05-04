<?php

namespace App\Http\Resources\Base;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SelectResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->hash,
            'name' => $this->name,
        ];
    }
}
