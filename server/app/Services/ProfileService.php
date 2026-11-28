<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;

class ProfileService
{
    /**
     * Get the authenticated user's profile.
     */
    public function show(User $user): Profile
    {
        return $user->profile()->firstOrFail();
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param array<string, mixed> $data
     */
    public function update(User $user, array $data): Profile
    {
        $profile = $user->profile()->firstOrFail();

        $profile->update($data);

        return $profile->fresh();
    }
}
