<?php

namespace Database\Factories;

use App\Models\Enums\UserTypes;
use App\Models\Group;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'      => $this->faker->sentence,
            'start_at'   => $this->faker->dateTime,
            'end_at'     => $this->faker->dateTime,
            'room_id'    => Room::inRandomOrder()->first()->id,
            'group_id'   => Group::inRandomOrder()->first()->id,
            'teacher_id' => User::whereType(UserTypes::TEACHER)->inRandomOrder()->first()->id
        ];
    }
}
