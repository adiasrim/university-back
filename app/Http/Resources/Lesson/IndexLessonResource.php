<?php

namespace App\Http\Resources\Lesson;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Lesson */
class IndexLessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'start_at'   => $this->start_at->format('Y-m-d H:i:s'),
            'end_at'     => $this->end_at->format('Y-m-d H:i:s'),
            'group'      => $this->group->name,
            'teacher'    => $this->teacher->full_name,
            'room'       => $this->room->name,
        ];
    }
}
