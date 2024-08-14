<?php

namespace App\Notifications;

use Alhelwany\LaravelMtn\Channels\MTNChannel;
use Alhelwany\LaravelMtn\Enums\Lang;
use Alhelwany\LaravelMtn\Interfaces\MTNNotification;
use App\Models\Verification;
use Illuminate\Notifications\Notification;

class OTP extends Notification implements MTNNotification
{
	private string $code;

	public function __construct(Verification $verification)
	{
		$this->code = $verification->code;
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
		return trans('notifications.otp.text') . $this->code;
	}

	public function getLang(): Lang
	{
		return Lang::AR;
	}
}
