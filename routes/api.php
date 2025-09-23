<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('fetch-all-studend', [StudentController::class, 'index'])
//     ->name('fetch-all-student');

Route::group(['prefix' => 'student'], function () {
    Route::get('fetch-student/{id}', [StudentController::class, 'show']);
    Route::get('fetch-all-student', [StudentController::class, 'index']);

    Route::post('create-student', [StudentController::class, 'store']);

    Route::put('update-student/{id}', [StudentController::class, 'update']);

    Route::delete('delete-student/{id}', [StudentController::class, 'destroy']);

});

Route::group(['prefix' => 'user'], function () {
    Route::get('fetch-user/{id}', [UserController::class, 'fetchSingleUser']);

    Route::get('fetch-all-users', [UserController::class, 'index']);

    Route::post('create-user', [UserController::class, 'create']);

    Route::put('update-user/{id}', [UserController::class, 'update']);

    Route::delete('delete-user/{id}', [UserController::class, 'destroy']);

});

Route::group(['prefix' => 'product'], function () {
    Route::get('fetch-product/{id}', [ProductController::class, 'show']);
    Route::get('fetch-all-products', [ProductController::class, 'index']);

    Route::post('create-product', [ProductController::class, 'store']);

    Route::put('update-product/{id}', [ProductController::class, 'update']);

    Route::delete('delete-product/{id}', [ProductController::class, 'destroy']);

});
