<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\PostController;
use App\Http\Controllers\V1\CommentController;
use App\Http\Controllers\V1\ProductController;

Route::prefix('v1')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);


    Route::group(['middleware' => 'jwt.verify'], function () {
        Route::get('/unlog', [AuthController::class, 'unlog']);
        Route::get('/user', [AuthController::class, 'getUser']);

        Route::apiResources([
            'posts' => PostController::class,
            'comments' => CommentController::class,
            'products' => ProductController::class,
        ]);

    });
});
