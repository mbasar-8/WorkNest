<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register(
    $request->validated()
);

event(new Registered($user));

        return response()->json([
            'success' => true,
            'message' => 'Registration successful. Please verify your email before logging in.',
            'data' => new UserResource($user),
        ], 201);
    }
}
