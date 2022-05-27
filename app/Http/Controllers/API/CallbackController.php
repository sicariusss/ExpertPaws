<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Callback;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CallbackController extends Controller
{
    /**
     * @param int $userId
     * @return Response
     */
    public function callbacks(int $userId): Response
    {
        return response()->json(['callbacks' => Callback::where('user_id', $userId)->get()], Response::HTTP_OK);
    }
}
