<?php

namespace App\Exceptions\Auth;

use App\Exceptions\BaseException;

class CodeExpired extends BaseException
{
    public function __construct()
    {
        parent::__construct("Code Expired", 0, null);
    }

    public static function getExceptionHttpStatus()
    {
        return 403;
    }

    public static function getExceptionCode()
    {
        return 'code_expired';
    }
}
