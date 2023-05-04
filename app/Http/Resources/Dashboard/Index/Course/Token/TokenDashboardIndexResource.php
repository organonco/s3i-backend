<?php

namespace App\Http\Resources\Dashboard\Index\Course\Token;

use App\Http\Resources\Base\Course\Token\TokenResource;
use Illuminate\Http\Request;

class TokenDashboardIndexResource extends TokenResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['student'] = $this->student ? $this->student->name_en : 'Not Used';
        return $base;
    }
}
