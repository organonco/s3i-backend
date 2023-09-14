<?php

namespace App\Notifications;

use App\Models\CourseHomework;
use App\Models\CourseQuiz;

class QuizFeedbackAdded extends BaseNotification
{

    private CourseQuiz $courseQuiz;

    /**
     * @param CourseQuiz $courseQuiz
     */
    public function __construct(CourseQuiz $courseQuiz)
    {
        $this->courseQuiz = $courseQuiz;
    }

    public function getTitle(): string
    {
        return trans('notifications.quiz_feedback_added.title');
    }

    public function getText(): string
    {
        return $this->courseQuiz->name;
    }

    public function getActionUrl(): array
    {
        return [
            'screen_name' => "QUIZ",
            'params' => [
                'quiz_id' => $this->courseQuiz->courseItem->hash,
            ]
        ];
    }
}
