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

Route::get('lang/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return back();
});


Auth::routes();


Route::middleware('auth')->group(function () {
    Route::get('/', 'DashboardController@index')->name('movies.index');
    Route::get('/details', 'DetailsController@index')->name('detail.index');
    Route::put('/movies-delete/{imdbID}', 'DetailsController@delete')->name('movies.deleete');

    Route::get('/movies/{imdbID}', 'DashboardController@show')->name('movies.show');
    Route::put('/movies-update/{imdbID}', 'DashboardController@save')->name('movies.save');

});
