<?php

namespace App\Notifications;

class PurchaseProcessing extends BaseNotification
{

    public function __construct()
    {
    }

    public function getTitle(): string
    {
        return trans('notifications.purchase_processing.title');
    }

    public function getText(): string
    {
        return trans('notifications.purchase_processing.text');
    }

    public function getActionUrl(): array
    {
        return [
            'screen_name' => "MY_COURSES",
        ];
    }
}
