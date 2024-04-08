<?php

namespace App\Notifications;

use App\Models\Purchase;

class PurchaseFailed extends BaseNotification
{
    public function __construct()
    {
    }

    public function getTitle(): string
    {
        return trans('notifications.purchase_failed.title');
    }

    public function getText(): string
    {
        return trans('notifications.purchase_failed.text');
    }

    public function getActionUrl(): array
    {
        return [
            'screen_name' => "MY_COURSES",
        ];
    }
}
