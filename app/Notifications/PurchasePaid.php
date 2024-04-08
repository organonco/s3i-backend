<?php

namespace App\Notifications;

use App\Models\Course;
use App\Models\Purchase;

class PurchasePaid extends BaseNotification
{

    /**
     * @param Course $course
     */
    public function __construct(private Course $course)
    {
    }

    public function getTitle(): string
    {
        return trans('notifications.purchase_paid.title');
    }

    public function getText(): string
    {
        return trans('notifications.purchase_paid.text') . $this->course->name;
    }

    public function getActionUrl(): array
    {
        return [
            'screen_name' => "MY_COURSES",
        ];
    }
}
