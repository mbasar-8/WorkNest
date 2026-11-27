<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\AuthService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;

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

    /**
     * Authenticate a user.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->login(
                $request->validated()
            );

            return response()->json([
                'success' => true,
                'message' => 'Login successful.',
                'data' => [
                    'token' => $result['token'],
                    'token_type' => $result['token_type'],
                    'user' => new UserResource($result['user']),
                ],
            ]);
        } catch (AuthenticationException $exception) {
            $status = $exception->getMessage() === 'Please verify your email before logging in.'
                ? 403
                : 401;

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], $status);
        }
    }

    /**
 * Logout the authenticated user.
 */
public function logout(): JsonResponse
{
    $this->authService->logout(auth()->user());

    return response()->json([
        'success' => true,
        'message' => 'Logout successful.',
    ]);
}
}
