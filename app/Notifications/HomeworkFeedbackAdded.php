<?php

namespace App\Notifications;

use App\Models\CourseHomework;

class HomeworkFeedbackAdded extends BaseNotification
{

    private CourseHomework $courseHomework;

    /**
     * @param CourseHomework $courseHomework
     */
    public function __construct(CourseHomework $courseHomework)
    {
        $this->courseHomework = $courseHomework;
    }

    public function getTitle(): string
    {
        return trans('notifications.homework_feedback_added.title');
    }

    public function getText(): string
    {
        return $this->courseHomework->name;
    }

    public function getActionUrl(): string
    {
        return '';
    }
}
