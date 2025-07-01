<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

Route::prefix('authors')->group(function () {
    Route::resource('', AuthorController::class)->parameters(['' => 'author']);
});

Route::prefix('books')->group(function(){
    Route::resource('', BookController::class)->parameters([''=>'book']);
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