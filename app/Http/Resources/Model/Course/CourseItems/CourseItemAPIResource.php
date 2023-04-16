<?php

namespace App\Http\Resources\Model\Course\CourseItems;
use App\Interfaces\HasCourseItemInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseItemAPIResource extends JsonResource
{
    public function toArray(Request $request) : array
    {
        return [
            'id' => $this->item->hash,
            'type' => $this->type,
            'object' => $this->getCourseItemObjectResource($this->item),
        ];
    }

    private function getCourseItemObjectResource(HasCourseItemInterface $item)
    {
        return new ($item->getAPIResourceClass())($item);
    }
}
