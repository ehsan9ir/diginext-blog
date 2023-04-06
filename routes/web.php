<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::to('https://diginext-interview.stoplight.io/docs/website-interviews/k50hofbzwuopr-back-end-interview-task');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
