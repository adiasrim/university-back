<?php

use App\Models\Group;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->foreignIdFor(Room::class);
            $table->foreignIdFor(Group::class);
            $table->foreignIdFor(User::class, 'teacher_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
