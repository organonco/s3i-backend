<?php

namespace App\Exceptions\Course;

use App\Exceptions\BaseException;

class AlreadySubmitted extends BaseException
{
    public function __construct()
    {
        parent::__construct("Already Submitted", 0, null);
    }

    public static function getExceptionHttpStatus()
    {
        return 409;
    }

    public static function getExceptionCode()
    {
        return 'already_submitted';
    }
}
