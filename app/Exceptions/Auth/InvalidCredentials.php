<?php

namespace App\Exceptions\Auth;

use App\Exceptions\BaseException;

class InvalidCredentials extends BaseException
{
    public function __construct()
    {
        parent::__construct("Invalid Credentials", 0, null);
    }

    public static function getExceptionHttpStatus()
    {
        return 401;
    }

    public static function getExceptionCode()
    {
        return 'invalid_credentials';
    }
}
