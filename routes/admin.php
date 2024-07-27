<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController;
use Illuminate\Support\Facades\Route;

Route::apiResource('user',UserController::class)->except(['show','update','destroy']);
Route::get('user/{user}',[UserController::class,'show']);
Route::patch('user/{user}',[UserController::class,'update']);
Route::delete('user/{user}',[UserController::class,'destroy']);

Route::apiResource('article',ArticleController::class)->only(['index']);