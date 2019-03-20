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

Route::get('/event/{id}', 'EventsController@singleEvent');
Route::get('/myEvents', 'EventsController@myEvents');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Api 
Route::get('/api/events', 'EventsController@index');
Route::post('/api/events/createEvent', 'EventsController@create');
Route::get('/api/events/eventSearch/{searchString}', 'EventsController@search');
Route::get('/api/events/eventFilter/date/{date}', 'EventsController@filterByDate');
Route::get('/api/events/eventFilter/city/{city}', 'EventsController@filterByCity');
Route::get('/api/events/deleteEvent/{id}', 'EventsController@delete');
//Route::get('/api/events/singleEvent/{id}', 'EventsController@singleEvent');

Route::post('/api/going/add', 'GoingController@create');
Route::post('/api/going/remove', 'GoingController@delete');
