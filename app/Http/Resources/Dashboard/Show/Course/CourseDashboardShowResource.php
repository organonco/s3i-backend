<?php

namespace App\Http\Resources\Dashboard\Show\Course;

use App\Http\Resources\Base\Course\CourseResource;
use App\Http\Resources\Dashboard\Show\Course\Item\CourseItemDashboardShowResource;
use Illuminate\Http\Request;

class CourseDashboardShowResource extends CourseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['items'] = CourseItemDashboardShowResource::collection($this->whenLoaded('courseItems'));
        $base['category'] = CategoryDashboardShowResource::make($this->whenLoaded('category'));
        $base['user_ids'] = $this->users->plucK('hash');
        $base['telegram_url'] = $this->telegram_url;
        return $base;
    }
}
