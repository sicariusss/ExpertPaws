<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

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

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws FileNotFoundException
     */
    public function form(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            $review = new Review();
            $review->setDescription($data['description']);
            if (isset($data['image'])) {
                $review->setImage(Review::uploadImage($data['image']));
            }
            $review->setUserId($data['user_id']);
            $review->setAnon($data['anon'] === 'true');
            $review->setPublished(false);
            $review->save();

            $success = true;
            $message = 'Спасибо, Ваш отзыв отправлен, он появится на сайте после проверки';
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
