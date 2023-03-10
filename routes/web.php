<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('guest.home');
// })->name('guest.home');

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'PageController@dashboard')->name('dashboard');
        Route::get('/messages', 'MessageController@index')->name('messages.index');
        Route::get('/messages/{message}', 'MessageController@show')->name('messages.show');
        Route::delete('/messages/{message}', 'MessageController@destroy')->name('messages.destroy');
        Route::get('/reviews', 'ReviewController@index')->name('reviews.index');
        Route::get('/reviews/{review}', 'ReviewController@show')->name('reviews.show');
        Route::get('/users/{user}', 'UserController@show')->name('users.show');
        Route::put('/users/{user}', 'UserController@update')->name('users.update');
        Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
        Route::get('/sponsors', 'SponsorController@index')->name('sponsors.index');
        Route::get('/sponsors/{sponsor}', 'SponsorController@show')->name('sponsors.show');
        //Rotte pagamento
        Route::get('/sponsors/payment/{value}', 'SponsorController@payment')->name('sponsors.payment');
        //TODO: da verificare
        Route::post('/checkout', 'SponsorController@checkout')->name('sponsors.checkout');
});

Route::get('{any?}', function () {
    return view('guest.home');
})->where("any", ".*")->name('guest.home');
