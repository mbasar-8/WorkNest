<?php

namespace App\Services\Auth;

use App\Enums\OtpType;
use App\Models\User;
use App\Services\UserOtpService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Profile;

class AuthService
{
    public function __construct(
        protected UserOtpService $userOtpService,
    ) {
    }

    /**
     * Register a new user.
     */
    public function register(array $data): User
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password'],
    ]);

    Profile::create([
        'user_id' => $user->id,
    ]);

    $this->userOtpService->send(
        $user,
        OtpType::EMAIL_VERIFICATION
    );

    return $user;
}

    /**
     * Authenticate user.
     *
     * @throws AuthenticationException
     */
    public function login(array $data): array
    {
        $user = $this->findUserByEmail($data['email']);

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw new AuthenticationException(
                'Invalid credentials.'
            );
        }

        if (! $user->hasVerifiedEmail()) {
            throw new AuthenticationException(
                'Please verify your email before logging in.'
            );
        }

        $token = $user
            ->createToken('worknest-api')
            ->plainTextToken;

        return [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ];
    }

    /**
     * Logout authenticated user.
     */
    public function logout(User $user): void
    {
        $user->currentAccessToken()?->delete();
    }

    /**
     * Verify email OTP.
     *
     * @throws ValidationException
     */
    public function verifyEmailOtp(array $data): void
    {
        $user = $this->findUserByEmail($data['email']);

        if (! $user) {
            $this->throwUserNotFound();
        }

        if ($user->hasVerifiedEmail()) {
            $this->throwAlreadyVerified();
        }

        $this->userOtpService->verify(
            $user,
            OtpType::EMAIL_VERIFICATION,
            $data['otp']
        );

        $user->markEmailAsVerified();
    }


        /**
     * Resend email verification OTP.
     *
     * @throws ValidationException
     */
    public function resendEmailOtp(array $data): void
    {
        $user = $this->findUserByEmail($data['email']);

        if (! $user) {
            $this->throwUserNotFound();
        }

        if ($user->hasVerifiedEmail()) {
            $this->throwAlreadyVerified();
        }

        $this->userOtpService->send(
            $user,
            OtpType::EMAIL_VERIFICATION
        );
    }

    /**
     * Send password reset OTP.
     */
    public function forgotPassword(array $data): void
    {
        $user = $this->findUserByEmail($data['email']);

        if (! $user) {
            return;
        }

        $this->userOtpService->send(
            $user,
            OtpType::PASSWORD_RESET
        );
    }

    /**
     * Reset user password.
     *
     * @throws ValidationException
     */
    public function resetPassword(array $data): void
    {
        $user = $this->findUserByEmail($data['email']);

        if (! $user) {
            $this->throwUserNotFound();
        }

        $this->userOtpService->verify(
            $user,
            OtpType::PASSWORD_RESET,
            $data['otp']
        );

        $user->update([
            'password' => $data['password'],
        ]);
    }

    /**
     * Find a user by email address.
     */
    private function findUserByEmail(string $email): ?User
    {
        return User::query()
            ->where('email', strtolower(trim($email)))
            ->first();
    }

    /**
     * Throw a validation exception when the user cannot be found.
     */
    private function throwUserNotFound(): never
    {
        throw ValidationException::withMessages([
            'email' => [
                'No account found with this email address.',
            ],
        ]);
    }

    /**
     * Throw a validation exception when the email is already verified.
     */
    private function throwAlreadyVerified(): never
    {
        throw ValidationException::withMessages([
            'email' => [
                'Email is already verified.',
            ],
        ]);
    }
}
