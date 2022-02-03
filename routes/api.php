<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;





Route::prefix('v1')->group(function () {

    Route::apiResource('books', BookController::class);
});
