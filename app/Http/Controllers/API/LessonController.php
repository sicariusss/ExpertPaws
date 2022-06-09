<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends Controller
{
    /**
     * @param string $chapterId
     * @return Response
     */
    public function lessons(string $chapterId): Response
    {
        return response()->json(['lessons' => Lesson::where('chapter_id', $chapterId)->get()], Response::HTTP_OK);
    }

    /**
     * @param string $slug
     * @return Response
     */
    public function lesson(string $slug): Response
    {
        return response()->json(['lesson' => Lesson::firstWhere('slug', $slug)], Response::HTTP_OK);
    }
}
