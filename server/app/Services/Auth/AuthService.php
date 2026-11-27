<?php

namespace App\Services\Auth;

use App\Models\User;

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
}
