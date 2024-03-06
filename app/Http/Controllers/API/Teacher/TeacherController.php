<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Student\Notifications\IndexRequest;
use App\Http\Requests\API\Student\Notifications\MarkAsReadRequest;
use App\Http\Resources\API\Notifications\NotificationResource;
use App\Http\Resources\API\Teacher\TeacherAPIResource;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\User;


/**
 * @group Teachers
 */
class TeacherController extends Controller
{
    /**
     * Index
     */
    public function index()
    {
        return [
            'teachers' => TeacherAPIResource::collection(User::query()->teachers()->visible()->get())
        ];
    }
}
