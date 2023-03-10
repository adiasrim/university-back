<?php

namespace App\Actions\Lesson;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class IndexLessonAction
{
    public function __construct(private readonly Lesson $lesson)
    {
    }

    public function execute(?string $filter, User $user): Collection
    {
        return $this
            ->lesson
            ->query()
            ->searchByUser($user)
            ->withRelations()
            ->filter($filter)
            ->get();
    }
}