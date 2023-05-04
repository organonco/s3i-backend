<?php

namespace App\Http\Resources\Dashboard\Index\Course\Token;

use App\Http\Resources\Base\Course\Token\TokenBatchResource;
use App\Traits\ImplodesArrays;
use Illuminate\Http\Request;

class TokenBatchDashboardIndexResource extends TokenBatchResource
{
    use ImplodesArrays;

    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['courses'] = $this->pluckNameAndImplode($this->courses);
        $base['tags'] = $this->pluckNameAndImplode($this->tags);
        return $base;
    }
}
