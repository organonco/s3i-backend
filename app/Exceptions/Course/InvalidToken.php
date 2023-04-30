<?php

namespace App\Exceptions\Course;

use App\Exceptions\BaseException;

class InvalidToken extends BaseException
{
    public function __construct()
    {
        parent::__construct("Invalid Token", 0, null);
    }

    public static function getExceptionHttpStatus()
    {
        return 403;
    }

    public static function getExceptionCode()
    {
        return 'invalid_token';
    }
}
