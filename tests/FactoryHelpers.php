<?php

namespace Tests;

use App\Models\Lesson;
use App\Models\User;

trait FactoryHelpers
{
    protected function createUser(array $attributes = []): User
    {
        return User::factory()->create($attributes);
    }

    protected function createLesson(array $attributes = []): Lesson
    {
        return Lesson::factory()->create($attributes);
    }

    protected function authenticate(User $user): self
    {
        $this->actingAs($user);

        return $this;
    }
}