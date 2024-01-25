<?php

namespace App\Notifications;

use App\Models\Course;

class NewItemsAdded extends BaseNotification
{

    private Course $course;

    /**
     * @param Course $course
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function getTitle(): string
    {
        return trans('notifications.new_items_added.title');
    }

    public function getText(): string
    {
        return $this->course->name;
    }

    public function getActionUrl(): array
    {
        return [
            'screen_name' => "COURSE",
            'params' => [
                'course_id' => $this->course->hash,
            ]
        ];
    }
}
