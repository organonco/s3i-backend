<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUUID
{
    public static function findByUUID($uuid)
    {
        return static::query()->where('uuid', $uuid);
    }

    protected static function bootHasUUID()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function getUUID()
    {
        return $this->uuid;
    }
}
