<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OTP Expiry
    |--------------------------------------------------------------------------
    |
    | Number of minutes an OTP remains valid.
    |
    */

    'expiry_minutes' => (int) env('OTP_EXPIRY_MINUTES', 10),

    /*
    |--------------------------------------------------------------------------
    | Maximum OTP Attempts
    |--------------------------------------------------------------------------
    |
    | Maximum number of invalid attempts before the OTP is deleted.
    |
    */

    'max_attempts' => (int) env('OTP_MAX_ATTEMPTS', 5),

    /*
    |--------------------------------------------------------------------------
    | OTP Resend Cooldown
    |--------------------------------------------------------------------------
    |
    | Minimum number of seconds a user must wait before requesting
    | another OTP.
    |
    */

    'resend_cooldown' => (int) env('OTP_RESEND_COOLDOWN', 60),

];
