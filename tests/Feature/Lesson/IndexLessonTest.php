<?php

namespace Tests\Feature\Lesson;

use App\Models\Enums\UserTypes;
use App\Models\Lesson;
use Tests\TestCase;

class IndexLessonTest extends TestCase
{
    protected bool $shouldRunSeeders = true;

    public function test_index_lesson(): void
    {
        $this->getJson(route('lessons.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'start_at',
                        'end_at',
                        'room',
                        'group',
                        'teacher',
                    ],
                ],
            ]);
    }

    public function test_filter_lessons_by_group(): void
    {
        $user = $this->createUser([
            'type' => UserTypes::ADMIN(),
        ]);
        $lesson = Lesson::first();

        $lesson->group()->update([
            'name' => 'Test Group'
        ]);

        $this
            ->actingAs($user, 'sanctum')
            ->getJson(route('lessons.index', ['filter' => 'Group']))
            ->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'group' => 'Test Group',
                    ],
                ],
            ]);
    }
}
