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
    public function scopeFilter(Builder $query, array $data)
    {
        return $query
            ->filterByGroup($data['group'] ?? null)
            ->filterByTeacher($data['teacher'] ?? null)
            ->filterByRoom($data['room'] ?? null)
            ->filterByStartAt($data['start_at'] ?? null)
            ->filterByEndAt($data['end_at'] ?? null);
    }

    public function scopeFilterByGroup(Builder $builder, ?string $group): Builder
    {
        return $builder
            ->when($group, fn($query) => $query
                ->whereHas('group', fn($query) => $query
                    ->where('name', 'like', '%' . $group . '%')));
    }

    public function scopeFilterByTeacher(Builder $builder, ?string $teacher): Builder
    {
        return $builder
            ->when($teacher, fn($query) => $query
                ->whereHas('teacher', fn($query) => $query
                    ->where('first_name', 'like', '%' . $teacher . '%')
                    ->orWhere('last_name', 'like', '%' . $teacher . '%')));
    }

    public function scopeFilterByRoom(Builder $builder, ?string $room): Builder
    {
        return $builder
            ->when($room, fn($query) => $query
                ->whereHas('room', fn($query) => $query
                    ->where('name', 'like', '%' . $room . '%')));
    }

    public function scopeFilterByStartAt(Builder $builder, ?string $startAt): Builder
    {
        return $builder
            ->when($startAt, fn($query) => $query
                ->where('start_at', $startAt));
    }

    public function scopeFilterByEndAt(Builder $builder, ?string $endAt): Builder
    {
        return $builder
            ->when($endAt, fn($query) => $query
                ->where('end_at', $endAt));
    }

    public function scopeWithRelations(Builder $query): Builder
    {
        return $query->with(['group', 'teacher', 'room']);
    }
}