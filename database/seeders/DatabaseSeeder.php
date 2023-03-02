<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Enums\UserTypes;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->createQuietly([
            'type' => UserTypes::TEACHER()
        ]);

        User::factory()->createQuietly([
            'first_name' => 'Mirik',
            'email'      => 'akhmedovmirik@gmail.com',
            'type'       => UserTypes::ADMIN()
        ]);

        Room::factory(5)->createQuietly();
        Group::factory(5)->createQuietly();
        Lesson::factory(25)->createQuietly();
    }
}
