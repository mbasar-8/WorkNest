<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Register a new user.
     */
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => $data['password'],
        ]);
    }

    /**
     * Authenticate a user and generate an API token.
     *
     * @throws AuthenticationException
     */
    public function login(array $data): array
    {
        $user = User::where('email', strtolower($data['email']))->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw new AuthenticationException('Invalid credentials.');
        }

        if (! $user->hasVerifiedEmail()) {
            throw new AuthenticationException(
                'Please verify your email before logging in.'
            );
        }

        $token = $user->createToken('worknest-api')->plainTextToken;

        return [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ];
    }


    /**
 * Logout the authenticated user.
 */
public function logout(User $user): void
{
    $user->currentAccessToken()?->delete();
}
}
