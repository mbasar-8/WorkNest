<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'WorkNest API is running.',
    ]);
});

require __DIR__.'/api/auth.php';
