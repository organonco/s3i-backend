<?php

namespace App\Enums;

enum CourseQuizQuestionTypes : string
{
    case TEXT = 'TEXT';
    case CHECK = 'CHECK';
    case RADIO = 'RADIO';
}
