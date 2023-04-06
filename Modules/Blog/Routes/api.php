<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\V1\PostController;
use Modules\Blog\Http\Controllers\V1\VideoController;

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

Route::group(['middleware' => 'has.userId'], function (){
    Route::post('post', [PostController::class, 'store']);
    Route::post('video', [VideoController::class, 'store']);

    Route::post('post/{post}/comment', [PostController::class, 'storeComment']);
});

Route::get('post/{post}', [PostController::class, 'show']);
Route::get('video/{video}', [VideoController::class, 'show']);
