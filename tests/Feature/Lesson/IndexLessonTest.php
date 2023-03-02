<?php

namespace Tests\Feature\Lesson;

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
        $lesson = Lesson::first();

        $lesson->group()->update([
            'name' => 'Test Group'
        ]);

        $this->getJson(route('lessons.index', ['group' => 'Group']))
            ->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'group' => 'Test Group',
                    ],
                ],
            ]);
    }

    public function test_filter_lessons_by_teacher(): void
    {
        $lesson = Lesson::first();

        $lesson->teacher()->update([
            'first_name' => 'Test',
            'last_name' => 'Teacher',
        ]);

        $this->getJson(route('lessons.index', ['teacher' => 'Teacher']))
            ->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'teacher' => 'Test Teacher',
                    ],
                ],
            ]);
    }

    public function test_filter_lessons_by_room(): void
    {
        $lesson = Lesson::first();

        $lesson->room()->update([
            'name' => 'Test Room',
        ]);

        $this->getJson(route('lessons.index', ['room' => 'Room']))
            ->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'room' => 'Test Room',
                    ],
                ],
            ]);
    }
}
