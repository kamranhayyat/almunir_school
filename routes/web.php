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
    return view('dashboard');
});

Route::get('/students', 'AdminController@show_std')->name('show-students');
Route::get('/students/import', 'AdminController@import_std')->name('import-students');
Route::post('/students/import', 'AdminController@import')->name('import-students_excel');
