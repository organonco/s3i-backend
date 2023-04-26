<?php

namespace App\Exceptions;

interface BaseExceptionInterface
{
    public static function getExceptionHttpStatus();

    public static function getExceptionCode();
}
