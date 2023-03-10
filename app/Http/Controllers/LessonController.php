<?php

namespace App\Http\Controllers;

use App\Actions\Lesson\IndexLessonAction;
use App\Http\Resources\Lesson\IndexLessonResource;
use Auth;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request, IndexLessonAction $lessonAction)
    {
        $lessons = $lessonAction->execute($request->get('filter'), Auth::user());

        return IndexLessonResource::collection($lessons);
    }
}