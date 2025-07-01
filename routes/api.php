<?php

use App\Http\Controllers\APIAuthorController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

Route::prefix('authors')->group(function () {
    // Custom search route
    Route::get('/search', [APIAuthorController::class, 'search']);

    // ✅ Correct resource declaration with custom name to avoid empty string
    Route::resource('', APIAuthorController::class)->parameters(['' => 'author']);
});



// Optional Auth Route (if auth is set up)
Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

// Fallback for 404 errors
Route::fallback(function () {
    return response()->json([
        'message' => 'Not Found. Check your route or endpoint.'
    ], 404);
});