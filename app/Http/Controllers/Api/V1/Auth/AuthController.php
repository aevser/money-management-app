<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth as Requests;
use App\Jobs\Auth as Jobs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Requests\RegisterRequest $request)
    {
        // Проверяем, есть ли такой E-mail уже в базе
        if (\App\Models\User::where('email', $request->email)->exists()) {
            return response()->json('E-mail уже зарегестрирован', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        Jobs\Register::dispatchSync(
            name: $request->name,
            email: $request->email,
            password: $request->password
        );

        return response()->json('Регистрация успешна', Response::HTTP_CREATED);
    } // Регистрация

    public function login(Requests\AuthRequest $request)
    {
        // Проверяем верные ли данные
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json('Неверные данные', Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();
        $token = $user->createToken('user_token')->plainTextToken;

        return response()->json(['name' => $user->name, 'token' => $token], Response::HTTP_OK);
    } // Логин

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        return response()->json('Успешно вышли из системы', Response::HTTP_OK);
    } // Выход
}
