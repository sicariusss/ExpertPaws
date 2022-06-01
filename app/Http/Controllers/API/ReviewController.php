<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    /**
     * @return Response
     */
    public function reviews(): Response
    {
        return response()->json(['reviews' => Review::with('user')->where('published', true)->where('image', null)->get()],
            Response::HTTP_OK);
    }

    /**
     * @return Response
     */
    public function gallery(): Response
    {
        return response()->json(['gallery' => Review::with('user')->where('published', true)->where('image', '<>', null)->get()],
            Response::HTTP_OK);
    }
}
