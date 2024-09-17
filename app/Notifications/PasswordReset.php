<?php

namespace App\Notifications;

use Alhelwany\LaravelMtn\Channels\MTNChannel;
use Alhelwany\LaravelMtn\Enums\Lang;
use Alhelwany\LaravelMtn\Interfaces\MTNNotification;
use App\Models\PasswordResetToken;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification implements MTNNotification
{
	private string $code;

	public function __construct(PasswordResetToken $passwordReset)
	{
		$this->code = $passwordReset->code;
	}
	
	 /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [MTNChannel::class];
    }

	public function toText(): string
	{
		return trans('notifications.password_reset.text') . $this->code;
	}

	public function getLang(): Lang
	{
		return Lang::AR;
	}
}
