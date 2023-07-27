<?php

namespace App\Notifications;

use App\Models\CourseMeeting;

class MeetingSet extends BaseNotification
{

    private CourseMeeting $courseMeeting;

    /**
     * @param CourseMeeting $courseMeeting
     */
    public function __construct(CourseMeeting $courseMeeting)
    {
        $this->courseMeeting = $courseMeeting;
    }
    
    public function getTitle(): string
    {
        return trans('notifications.meeting_set.title');
    }

    public function getText(): string
    {
        return $this->courseMeeting->name;
    }

    public function getActionUrl(): string
    {
        return '';
    }
}
