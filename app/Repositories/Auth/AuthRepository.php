<?php

namespace App\Repositories\Auth;


use App\Services\Auth\IAuthRepository;
use App\User;
use Illuminate\Support\Facades\Auth;


class AuthRepository implements IAuthRepository
{

    public function registerUser(object $request)
    {
        try {

            $user = new User;
            $user->nome = $request->input('nome');
            $user->email = $request->input('email');
            $user->password = app('hash')->make($request->input('password'));

            $user->save();
            return ['error' => '','user' => $user, 'message' => 'CREATED', 'status' => 201];

        } catch (\Exception $e) {
            return ['message' => 'Erro ao cadastrar usuário!', 'status' => 409];
        }
    }

    public function loginUser(array $credentials)
    {
        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Dados Incorretos.'], 409);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => \auth()->user()
        ], 200);
    }

    public function refresh()
    {
        $token = Auth::refresh();
        return $this->respondWithToken($token);
    }

}