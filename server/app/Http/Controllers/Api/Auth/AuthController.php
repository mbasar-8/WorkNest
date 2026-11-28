<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResendEmailOtpRequest;
use App\Http\Requests\Auth\VerifyEmailOtpRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\ResetPasswordRequest;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService,
    ) {
    }

    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Registration successful. Please verify your email using the OTP sent to your email address.',
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
        $this->authService->logout(
            auth()->user()
        );

        return response()->json([
            'success' => true,
            'message' => 'Logout successful.',
        ]);
    }

        /**
     * Verify a user's email address using OTP.
     */
    public function verifyEmail(VerifyEmailOtpRequest $request): JsonResponse
    {
        $this->authService->verifyEmailOtp(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully. You can now log in.',
        ]);
    }

    /**
     * Resend the email verification OTP.
     */
    public function resendEmailOtp(ResendEmailOtpRequest $request): JsonResponse
    {
        $this->authService->resendEmailOtp(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'A new verification OTP has been sent to your email address.',
        ]);
    }

    /**
     * Send a password reset OTP.
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $this->authService->forgotPassword(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'If an account exists with that email, a password reset OTP has been sent.',
        ]);
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $this->authService->resetPassword(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Password reset successful. You can now log in with your new password.',
        ]);
    }
}
