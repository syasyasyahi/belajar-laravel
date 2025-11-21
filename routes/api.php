<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json(['message' => 'Api is running!']);
});

Route::post('login', [\App\Http\Controllers\API\AuthController::class,'actionLogin']);
Route::get('me', [\App\Http\Controllers\API\AuthController::class,'me']);
