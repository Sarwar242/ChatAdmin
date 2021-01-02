<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
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
    Route::view('/', 'welcome')->name('index');
    Auth::routes();

    Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');

    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');

    Route::post('/login/admin', 'Auth\LoginController@adminLogin');

    Route::post('/register/admin', 'Auth\RegisterController@createAdmin');

    Route::view('/home', 'home')->middleware('auth');
    Route::group( [ 'middleware' => ['auth:web,admin'] ], function () {
        Broadcast::routes();
    });

    Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth:admin');


    Route::post('/chats/store', 'ChatController@store')->name('chat.store');
    Route::post('/chatsAdmin/store', 'ChatController@storeAdmin')->name('chat.admin.store');


    Route::get('/get-messages/{id}', function ($id) {
        return json_encode(App\Models\Message::where('user_id', $id)->get());
    });
    Route::get('/get-users', 'ChatController@getUsers')->name('users.get');
