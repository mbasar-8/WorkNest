<?php

namespace App\Services;

use App\Enums\OtpType;
use App\Models\User;
use App\Models\UserOtp;
use App\Notifications\UserOtpNotification;
use Illuminate\Validation\ValidationException;

class UserOtpService
{
    /**
     * Send an OTP to the user.
     */
    public function send(User $user, OtpType $type): void
    {
        $this->delete($user, $type);

        $otp = $this->generateOtp();

        UserOtp::create([
            'user_id'    => $user->id,
            'type'       => $type->value,
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(config('otp.expiry_minutes')),
            'attempts'   => 0,
        ]);

        $user->notify(
            new UserOtpNotification($otp, $type)
        );
    }

    /**
     * Verify an OTP.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function verify(
        User $user,
        OtpType $type,
        string $otp
    ): void {
        $record = UserOtp::query()
            ->where('user_id', $user->id)
            ->where('type', $type->value)
            ->latest()
            ->first();

        if (! $record) {
            throw ValidationException::withMessages([
                'otp' => ['OTP not found.'],
            ]);
        }

        if ($record->expires_at->isPast()) {
            $record->delete();

            throw ValidationException::withMessages([
                'otp' => ['OTP has expired.'],
            ]);
        }

        if ($record->attempts >= config('otp.max_attempts')) {
            $record->delete();

            throw ValidationException::withMessages([
                'otp' => ['Maximum OTP attempts exceeded.'],
            ]);
        }

        $otp = trim($otp);

        if ($record->otp !== $otp) {
            $record->increment('attempts');

            throw ValidationException::withMessages([
                'otp' => ['Invalid OTP.'],
            ]);
        }

        $record->delete();
    }

    /**
     * Delete an existing OTP.
     */
    public function delete(
        User $user,
        OtpType $type
    ): void {
        UserOtp::query()
            ->where('user_id', $user->id)
            ->where('type', $type->value)
            ->delete();
    }

    /**
     * Generate a six-digit OTP.
     */
    private function generateOtp(): string
    {
        return str_pad(
            (string) random_int(0, 999999),
            6,
            '0',
            STR_PAD_LEFT
        );
    }
}
