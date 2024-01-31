<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ImagesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group
|
*/

//Route::middleware(['auth:sanctum'])->group(function () {
//    Route::get('/user', function (Request $request) {
//        return $request->user();
//    });
//});


Route::controller(CategoriesController::class)
    ->name('categories.')
    ->prefix('categories')
    ->group(function () {
        Route::get('list', 'list')->name('list');
        Route::post('create', 'create')->name('create');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::get('show/{id}', 'show')->name('show');
    });

Route::controller(ImagesController::class)
    ->name('images.')
    ->prefix('images')
    ->group(function () {
        Route::post('upload', 'upload')->name('upload');
    });
//require __DIR__ . '/auth.php';
