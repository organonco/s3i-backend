<?php

namespace App\Http\Resources\API\Notifications;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge([
            'id' => $this->id,
            'read' => $this->read(),
        ], $this->data);
    }
}