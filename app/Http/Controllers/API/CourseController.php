<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Progress;
use App\Models\UserCourse;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    /**
     * @return Response
     */
    public function courses(): Response
    {
        return response()->json(['courses' => Course::get()], Response::HTTP_OK);
    }

    /**
     * @param string $slug
     * @return Response
     */
    public function course(string $slug): Response
    {
        return response()->json(['course' => Course::firstWhere('slug', $slug)], Response::HTTP_OK);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function purrchase(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            $purrchase = UserCourse::firstOrCreate([
                'user_id'   => $data['user_id'],
                'course_id' => $data['course_id'],
            ]);
            $purrchase->save();

            $progress = new Progress();
            $progress->setProgress(0);
            $progress->setUserId($data['user_id'] ?? Auth::id());
            $progress->setCourseId($data['course_id']);
            $progress->setLessonId(Course::getFirstLesson($data['course_id']));
            $progress->save();

            $success = true;
            $message = 'Курс приобретен';
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

    /**
     * @param int $userId
     * @return Response
     */
    public function userCourses(int $userId): Response
    {
        return response()->json(['user_courses' => UserCourse::getUserCourses($userId)], Response::HTTP_OK);
    }
}
