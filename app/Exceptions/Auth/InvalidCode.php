<?php

namespace App\Exceptions\Auth;

use App\Exceptions\BaseException;

class InvalidCode extends BaseException
{
    public function __construct()
    {
        parent::__construct("Invalid Code", 0, null);
    }

    public static function getExceptionHttpStatus()
    {
        return 403;
    }

    public static function getExceptionCode()
    {
        return 'invalid_code';
    }
}
