<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    /**
     * @param string $lessonId
     * @return Response
     */
    public function questions(string $lessonId): Response
    {
        return response()->json(['questions' => Question::with('answers')->where('lesson_id', $lessonId)->get()], Response::HTTP_OK);
    }
}
