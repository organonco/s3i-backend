<?php

namespace App\Notifications;

class GeneralNotification extends BaseNotification
{

    /**
     * @param string $text
     */
    public function __construct(private string $text)
    {
    }

    public function getTitle(): string
    {
        return "";
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getActionUrl(): array
    {
        return [
        ];
    }
}
