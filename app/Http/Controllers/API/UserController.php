<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $data = $request->all();
        try {
            $user = new User();
            $user->setSurname($data['surname']);
            $user->setName($data['name']);
            $user->setPatronymic($data['patronymic']);
            $user->setEmail($data['email']);
            $user->setPhone($data['phone']);
            $user->setPassword(Hash::make($data['password']));
            $user->setRoleId(Role::USER);
            $user->setPhoto('/images/photos/default-photo.png?' . Carbon::now());
            $user->save();

            $success = true;
            $message = 'Регистрация прошла успешно';
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
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $data = $request->all();

        $userData = [
            'email'    => $data['email'],
            'password' => $data['password'],
        ];

        if (Auth::attempt($userData)) {
            $success = true;
            $message = 'Вход в аккаунт прошел успешно';
        } else {
            $success = false;
            $message = 'Неверные данные или такой пользователь не зарегистрирован';
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Успешный выход из аккаунта';
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
     * @return Response
     */
    public function index(): Response
    {
        return response()->json(['users' => User::get()], Response::HTTP_OK);
    }
}
