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
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Polls
Route::get('/poll/{id}', 'PollController@get');
Route::get('/poll/{poll_id}/results', 'VoteController@getResultsView')->name('poll-results');
Route::post('/poll', 'PollController@store');
Route::put('/poll', 'PollController@edit');

// Votes
Route::post('/vote', 'VoteController@processVote');

// About
Route::get('/about', 'AboutController@about')->name('about');