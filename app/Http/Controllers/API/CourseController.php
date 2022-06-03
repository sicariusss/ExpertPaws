<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
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
}
