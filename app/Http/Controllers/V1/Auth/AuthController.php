<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\V1\Auth\IAuthService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class AuthController extends Controller
{
    private $service;

    public function __construct
    (
        IAuthService $service
    )
    {
//        $this->middleware('auth', ['except' => ['login', 'register']]);
        $this->service = $service;
    }

    public function register(Request $request)
    {
        return $this->service->register($request);
    }

    public function login(Request $request)
    {
        return $this->service->login($request);
    }

    public function refresh()
    {
       return $this->service->refresh();
    }

    public function logout()
    {
        auth()->logout();
        return ['error' => ''];
    }

    public function unauthorized()
    {
        return response()->json(['error' => 'Não Autorizado'], 401);
    }
}