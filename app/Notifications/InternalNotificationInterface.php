<?php

namespace App\Notifications;

interface InternalNotificationInterface
{
    public function getTitle(): string;
    public function getText(): string;
    public function getActionUrl(): string;
}