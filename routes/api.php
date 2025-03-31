<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/citas', [CitaController::class, 'index']);
    Route::post('/citas', [CitaController::class, 'store']);
    Route::get('/citas/{cita}', [CitaController::class, 'show']);
    Route::put('/citas/{cita}', [CitaController::class, 'update']);
    Route::delete('/citas/{cita}', [CitaController::class, 'destroy']);
});

Route::post('/login-token', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('API Token')->plainTextToken;

    return response()->json(['token' => $token]);
});