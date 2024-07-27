<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('/');

Auth::routes();

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['web'],'as' => 'admin.', 'prefix' => 'admin'], function(){

    Route::get('/home', 'IndexController@index')->name('home');

    Route::resources([
        'category' =>  'CategoryController',
    ], ['except' => ['edit','create','show']]);

    Route::resources([
        'product' =>  'ProductController',
    ]);
    
});