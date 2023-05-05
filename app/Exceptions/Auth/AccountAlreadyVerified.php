<?php

namespace App\Exceptions\Auth;

use App\Exceptions\BaseException;

class AccountAlreadyVerified extends BaseException
{
    public function __construct()
    {
        parent::__construct("Account Is Already Verified", 0, null);
    }

    public static function getExceptionHttpStatus()
    {
        return 403;
    }

    public static function getExceptionCode()
    {
        return 'account_already_verified';
    }
}
