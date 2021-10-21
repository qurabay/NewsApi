<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api','jsonc'],'prefix' => 'news'], function () {
    Route::post('/', [\App\Http\Controllers\NewsController::class,'store']);
    Route::get('/{id}',[\App\Http\Controllers\NewsController::class,'show']);
    Route::get('author/{id}',[\App\Http\Controllers\NewsController::class,'getByAuthor']);
    Route::get('tag/{id}',[\App\Http\Controllers\NewsController::class,'getByTag']);
});

Route::group(['middleware' => ['api','jsonc'],'prefix' => 'author'], function () {
    Route::get('/', [\App\Http\Controllers\AuthorController::class,'index']);
    Route::post('/', [\App\Http\Controllers\AuthorController::class,'store']);
    Route::post('upload/{id}', [\App\Http\Controllers\AuthorController::class,'upload']);

});

Route::group(['middleware' => ['api','jsonc'],'prefix' => 'tag'], function () {

    Route::post('/', [\App\Http\Controllers\TagsController::class,'store']);
});

Route::group(['middleware' => ['api','jsonc'],'prefix' => 'search'], function () {

    Route::post('/', [\App\Http\Controllers\SearchController::class,'index']);
});
