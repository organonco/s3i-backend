<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Student\Profile\NotificationsRequest;
use App\Http\Resources\API\Notifications\NotificationResource;

/**
 * @group Notifications
 * @authenticated
 */
class NotificationController extends Controller
{
    /**
     * Index
     * @responseFile  app/Http/Responses/Samples/Notification/index.json
     */
    public function index(NotificationsRequest $request)
    {
        return NotificationResource::collection($request->user()->notifications);
    }
}
