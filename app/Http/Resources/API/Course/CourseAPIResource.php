<?php

namespace App\Http\Resources\API\Course;

use App\Http\Resources\API\Course\Items\CourseItemAPIResource;
use App\Http\Resources\Base\Course\CourseResource;
use App\Models\Course;
use App\Traits\ChecksSubscription;
use Illuminate\Http\Request;

class CourseAPIResource extends CourseResource
{
    use ChecksSubscription;

    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        unset($base['students_limit']);

        $isSubscribed = $this->isSubscribedToCourse($this->id);

        $base['items'] = $this->when($isSubscribed, CourseItemAPIResource::collection($this->whenLoaded('courseItems')));
        $base['telegram_url'] = $this->when($isSubscribed, $this->telegram_url);
        $base['is_subscribed'] = $isSubscribed;
        return $base;
    }
}
