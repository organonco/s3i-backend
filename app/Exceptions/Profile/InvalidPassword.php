<?php

namespace App\Exceptions\Profile;

use App\Exceptions\BaseException;

class InvalidPassword extends BaseException
{
    public function __construct()
    {
        parent::__construct("Invalid Password", 0, null);
    }

    public static function getExceptionHttpStatus()
    {
        return 422;
    }

    public static function getExceptionCode()
    {
        return 'invalid_password';
    }
}
