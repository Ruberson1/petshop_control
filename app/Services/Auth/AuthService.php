<?php

namespace App\Services\Auth;

use App\Http\Controllers\V1\Auth\IAuthService;
use App\Services\Auth\IAuthRepository;
use Illuminate\Support\Facades\Validator;

class AuthService implements IAuthService
{
    private $repository;

    public function __construct
    (
        IAuthRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function register(object $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|min:2|max:20',
            'email' => 'required|email|max:100|email:rfc,dns',
            'password' => 'required|between:6,12',
        ]);

        if (!$validator->fails()) {

            $create = $this->repository->registerUser($request);

            if($create['status'] == 201) {
                return ['error' => '', 'data' => $this->login($request)];
            } else {
                return $create;
            }

        } else {
            return response()->json(['message' => $validator->errors()->first()]);
        }
    }

    public function login(object $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100|email:rfc,dns',
            'password' => 'required|between:6,12'
        ]);

        if (!$validator->fails()) {

            $credentials = $request->only(['email', 'password']);
            return response()->json($this->repository->loginUser($credentials), 201);

        } else {
            return response()->json(['message' => $validator->errors()->first()]);
        }
    }

    public function refresh()
    {
        return $this->repository->refresh();
    }
}