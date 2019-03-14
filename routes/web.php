<?php

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

// Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/eventFeed', 'EventsController@feed');

Route::get('/createEvent', function() {
    if (Auth::check()) {
        return view('createEvent');
    } else {
        return redirect('/');
    };
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Api 
Route::get('/api/events', 'EventsController@index');
Route::post('/api/events/createEvent', 'EventsController@create');
Route::get('/api/events/deleteEvent/{id}', 'EventsController@delete');
