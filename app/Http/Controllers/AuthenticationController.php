<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthenticationController extends Controller
{
    /**
     * @var \App\Services\AuthService
     */
    protected $authService;

    /**
     * AuthController constructor.
     *
     * @param \App\Services\AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function login(Request $request): JsonResponse
    {
        $auth = $this->authService->login($request->all());
        $auth = json_decode($auth, true);

        return response()
            ->json([
                'csrf_token' => $auth->csrf_token
            ])
            ->withCookie(
                'token',
                $auth->csrf_token,
                $auth->expires_in,
                '/'
            );
    }

    public function register(Request $request)
    {
        return $this->successResponse($this->authService->register($request->all()));
    }
}
