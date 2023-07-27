<?php

namespace App\Notifications;

use App\Models\CourseToken;

class TokenActivated extends BaseNotification
{

    private CourseToken $courseToken;

    /**
     * @param CourseToken $courseToken
     */
    public function __construct(CourseToken $courseToken)
    {
        $this->courseToken = $courseToken;
    }

    public function getTitle(): string
    {
        return trans('notifications.token_activated.title');
    }

    public function getText(): string
    {
        $courses = $this->courseToken->batch->courses()->pluck('name')->toArray();
        $count = sizeof($courses);
        $text = '';
        if ($count > 3) {
            $text = ' (+' . $count - 3 . ')';
            array_splice($courses, 3);
        }
        $text = implode(', ', $courses) . $text;
        return trans('notifications.token_activated.text') . $text;
    }

    public function getActionUrl(): string
    {
        return 'my-courses';
    }
}
