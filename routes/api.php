<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


// Route::get('fetch-all-studend', [StudentController::class, 'index'])
//     ->name('fetch-all-student');


Route::group(['prefix' => 'student'], function () {
    Route::get('fetch-student/{id}', [StudentController::class, 'show']);
    Route::get('fetch-all-student', [StudentController::class, 'index']);

    Route::post('create-student', [StudentController::class, 'store']);

});