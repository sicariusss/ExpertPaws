<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Progress;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function form(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            $progress = Progress::firstOrCreate([
                'user_id'   => $data['user_id'],
                'course_id' => $data['course_id'],
                'lesson_id' => $data['lesson_id'],
            ]);
            $progress->setProgress(100);
            $progress->save();

            $newProgress = Progress::firstOrCreate([
                'user_id'   => $data['user_id'],
                'course_id' => $data['course_id'],
                'lesson_id' => $data['lesson_id'] + 1,
            ]);
            $newProgress->setProgress(0);
            $newProgress->save();


            $success = true;
            $message = 'Прогресс сохранен';
        } catch (QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
}
