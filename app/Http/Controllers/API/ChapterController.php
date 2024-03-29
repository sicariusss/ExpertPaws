<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Symfony\Component\HttpFoundation\Response;

class ChapterController extends Controller
{
    /**
     * @param string $courseId
     * @return Response
     */
    public function chapters(string $courseId): Response
    {
        return response()->json(['chapters' => Chapter::with('lessons')->where('course_id', $courseId)->get()], Response::HTTP_OK);
    }

    /**
     * @param string $chapterId
     * @return Response
     */
    public function chapter(string $chapterId): Response
    {
        return response()->json(['chapter' => Chapter::firstWhere('id', $chapterId)], Response::HTTP_OK);
    }
}
