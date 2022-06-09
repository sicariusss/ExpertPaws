<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Progress;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProgressController extends Controller
{
    /**
     * @param int $userId
     * @param int $courseId
     * @return Response
     */
    public function progresses(int $courseId, int $userId): Response
    {
        return response()->json(['progresses'    => Progress::whereUserId($userId)->whereCourseId($courseId)->orderBy('created_at')->get(),
                                 'last_progress' => Progress::getLastProgress($userId, $courseId)], Response::HTTP_OK);
    }
}
