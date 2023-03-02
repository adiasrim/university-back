<?php

namespace App\Models\Relationships;

use App\Models\Enums\UserTypes;
use App\Models\Group;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait LessonRelationships
{
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function teacher(): BelongsTo
    {
        return $this
            ->belongsTo(User::class)
            ->whereType(UserTypes::TEACHER());
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}