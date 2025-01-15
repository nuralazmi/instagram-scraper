<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScraperController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('scrapper/get-posts-by-username/{username}', [ScraperController::class, 'getPostsByUsername']);
