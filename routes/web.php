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

Route::get('/students', 'AdminController@show_std')
->name('show-students');

Route::get('/students/import', 'AdminController@import_std')
->name('import-students');

Route::post('/students/import', 'AdminController@import')
->name('import-students_excel');

Route::get('/students/lesson-plan', 'AdminController@show_std_lesson')
->name('students-lesson-plan');

Route::get('/students/lesson-plan-upload', 'AdminController@upload_std_lesson')
->name('students-lesson-plan-upload');

Route::post('/students/lesson-plan-upload' , 'AdminController@upload_std_lesson_pdf')
->name('students-lesson-plan-upload-pdf');

Route::get('/download/{pdf}', 'AdminController@get_download')
->name('download-pdf');

Route::delete('/delete-pdf/{pdf}/{id}', 'AdminController@delete_pdf')
->name('delete-pdf');

Route::get('/students/study-material', 'AdminController@show_std_material')
->name('students-study-material');

Route::get('/students/study-material-upload', 'AdminController@study_material_upload')
->name('students-study-material-upload');

Route::post('/students/study-material-upload' , 'AdminController@upload_std_material_pdf')
->name('students-study-material-upload-pdf');

Route::get('/download/study/{pdf}', 'AdminController@get_download_material')
->name('download-pdf-material');

Route::delete('/delete-pdf-material/{pdf}/{id}', 'AdminController@delete_pdf_material')
->name('delete-pdf-material');

Route::get('/events', 'AdminController@events');
Route::get('/events/show', 'AdminController@show_events')->name('show-events');
Route::get('/events/create','AdminController@create');
Route::post('/events/create','AdminController@store')->name('store-event');