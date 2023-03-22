<?php

namespace App\Exceptions\Auth;

use App\Exceptions\BaseException;

class AccountIsFrozen extends BaseException
{
    public function __construct()
    {
        parent::__construct("Account Is Frozen", 0, null);
    }

    public static function getExceptionHttpStatus()
    {
        return 403;
    }

    public static function getExceptionCode()
    {
        return 'account_frozen';
    }
}
