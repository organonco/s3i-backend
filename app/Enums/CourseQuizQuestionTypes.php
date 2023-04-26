<?php

namespace App\Enums;

enum CourseQuizQuestionTypes: string
{
    case TEXT = 'text';
    case CHECK = 'check';
    case RADIO = 'radio';
}
