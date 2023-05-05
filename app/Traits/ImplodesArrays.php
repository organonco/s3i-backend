<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait ImplodesArrays
{
    public function pluckNameAndImplode(Collection $collection): string
    {
        return $this->implode($collection->pluck('name')->toArray());
    }

    public function implode(array $array, string $separator = " | "): string
    {
        return implode($separator, $array);
    }
}
