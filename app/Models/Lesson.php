<?php

namespace App\Models;

use App\Models\Relationships\LessonRelationships;
use App\Models\Scopes\LessonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory, LessonRelationships, LessonScopes;

    protected $casts = [
        'start_at' => 'datetime',
        'end_at'   => 'datetime',
    ];
}
