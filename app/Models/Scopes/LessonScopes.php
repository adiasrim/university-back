<?php

namespace App\Models\Scopes;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait LessonScopes
{
    public function scopeSearchByUser(Builder $query, User $user): Builder
    {
        return $query
            ->when($user->isTeacher(), function (Builder $query) use ($user) {
                return $query->where('teacher_id', $user->id);
            });
    }

    public function scopeFilter(Builder $query, ?string $filter)
    {
        return $query
            ->when($filter, function (Builder $query, string $filter) {
                return $query
                    ->filterByLesson($filter)
                    ->filterByTeacher($filter)
                    ->filterByGroup($filter)
                    ->filterByRoom($filter);
            });
    }

    public function scopeFilterByLesson(Builder $builder, ?string $lesson): Builder
    {
        return $builder
            ->where('title', 'like', "%{$lesson}%")
            ->orWhere('start_at', 'like', "%{$lesson}%")
            ->orWhere('end_at', 'like', "%{$lesson}%");
    }

    public function scopeFilterByGroup(Builder $builder, ?string $group): Builder
    {
        return $builder
            ->orWhereHas('group', function (Builder $query) use ($group) {
                $query->where('name', 'like', "%{$group}%");
            });
    }

    public function scopeFilterByTeacher(Builder $builder, ?string $teacher): Builder
    {
        return $builder
            ->orWhereHas('teacher', function (Builder $query) use ($teacher) {
                $query
                    ->where('first_name', 'like', "%{$teacher}%")
                    ->orWhere('last_name', 'like', "%{$teacher}%");
            });
    }

    public function scopeFilterByRoom(Builder $builder, ?string $room): Builder
    {
        return $builder
            ->orWhereHas('room', function (Builder $query) use ($room) {
                $query->where('name', 'like', "%{$room}%");
            });
    }

    public function scopeWithRelations(Builder $query): Builder
    {
        return $query->with(['group', 'teacher', 'room']);
    }
}