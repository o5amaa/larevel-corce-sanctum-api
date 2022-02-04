<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\UserAuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\LikeController;
use Illuminate\Support\Facades\Route;





Route::prefix('v1')->group(function () {

    // * Puplic rout
    Route::apiResource('books', BookController::class);

    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);


    // * Prodected rouet
    Route::group(['middleware' =>  ['auth:sanctum']], function () {
        //
        Route::get('/user', [UserAuthController::class, 'user']);
        Route::post('/logout', [UserAuthController::class, 'logout']);
        // Route::post('/books', [BookController::class,'store']);

        Route::post('books/{id}/like',[LikeController::class, 'like']);
        Route::post('books/{id}/dislike',[LikeController::class, 'dislike']);
    });
});

Route::fallback(function () {
    return response()->json([
        'message' => '404 | Page Not Found'
    ], 404);
});
