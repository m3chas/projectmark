<?php

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

// Public index of page, showing all community posts.
Route::get('/', 'IndexController@index')->name('index');

// Auth routes for registration, login, password reset, etc.
Auth::routes();

// Where we define a group route where we will pass our auth middleware, to include all routes inside as protected routes.
Route::group(['middleware' => ['auth']], function () {

    // Our home page where the user will see own posts.
    Route::get('/home', 'HomeController@index')->name('home');

    // Let's create a post resource route with only create method allowed.
    Route::resource('/posts', 'PostController')->only([
        'create','store'
    ]);
});
