<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Callback;
use App\Models\Contact;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * @return Response
     */
    public function contacts(): Response
    {
        return response()->json(
            [
                'emails'    => Contact::where('type', Contact::TYPE_EMAIL)->get(),
                'phones'    => Contact::where('type', Contact::TYPE_PHONE)->get(),
                'socials'   => Contact::where('type', Contact::TYPE_SOCIAL_NET)->get(),
                'addresses' => Contact::where('type', Contact::TYPE_ADDRESS)->get(),
            ],
            Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function form(Request $request): JsonResponse
    {
        $data = $request->all();
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ],[
            'name.required'=>'Имя',
            'email.required'=>'Почта',
            'subject.required'=>'Тема',
            'message.required'=>'Сообщение',
        ]);
        try {
            $callback = new Callback();
            $callback->setName($data['name']);
            $callback->setEmail($data['email']);
            $callback->setSubject($data['subject']);
            $callback->setMessage($data['message']);
            $callback->setUserId($data['user_id'] ?? null);
            $callback->save();

            $success = true;
            $message = 'Ваше сообщение отправлено';
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
