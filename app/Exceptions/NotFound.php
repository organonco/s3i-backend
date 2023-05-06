<?php

namespace App\Exceptions;

class NotFound extends BaseException
{
    public function __construct()
    {
        parent::__construct("Not Found", 0, null);
    }

    public static function getExceptionHttpStatus()
    {
        return 404;
    }

    public static function getExceptionCode()
    {
        return 'not_found';
    }
}
