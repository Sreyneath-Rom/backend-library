<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Author routes
Route::apiResource('authors', AuthorController::class);

// Book routes
Route::apiResource('books', BookController::class);

// Optional Auth route
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Fallback route
Route::fallback(function () {
    return response()->json([
        'message' => 'Not Found. Check your route or endpoint.'
    ], 404);
});