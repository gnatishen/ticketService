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

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/contacts', function () {
    return view('frontend.contacts');
});
Route::get('/ticketStatus', function () {
    return view('frontend.ticketStatus');
});
Route::get('/clientSearch/{phone}', 'FrontendController@clientSearch');
Route::post('/addTicket','FrontendController@addTicket');
Route::post('/ticketStatus','FrontendController@ticketStatus');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
