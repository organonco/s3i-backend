<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Student\Notifications\IndexRequest;
use App\Http\Requests\API\Student\Notifications\MarkAsReadRequest;
use App\Http\Resources\API\Notifications\NotificationResource;
use Illuminate\Notifications\DatabaseNotification;

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
    public function index(IndexRequest $request)
    {
        return NotificationResource::collection($request->user()->notifications);
    }

    /**
     * Count (unread)
     * @response 4
     */
    public function count(IndexRequest $request)
    {
        return $request->user()->notifications()->unread()->count();
    }

    /**
     * Mark As Read
     */
    public function markAsRead(MarkAsReadRequest $request, $id)
    {
        /** @var ?DatabaseNotification $notification */
        $notification = $request->user()->notifications()->find($id);
        if (!is_null($notification))
            $notification->markAsRead();
        return [
            'notifications' => NotificationResource::collection($request->user()->notifications),
            'count' => $request->user()->notifications()->unread()->count()
        ];
    }
}
