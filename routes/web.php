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

// Route::get('/students/import', 'AdminController@import_std')
//     ->name('import-students');

//     Route::post('/students/import', 'AdminController@import')
//     ->name('import-students-excel');

Route::group(['middleware' => 'auth'], function () {
    // User needs to be authenticated to enter here.

    //admin routes
    Route::get('/', 'AdminController@index')->name('index');

    Route::get('/students', 'AdminController@show_std')
    ->name('show-students');

    Route::get('/searchStudents', 'AdminController@searchStudents')
    ->name('search-students');

    Route::get('/students/import', 'AdminController@import_std')
    ->name('import-students');

    Route::post('/students/import', 'AdminController@import')
    ->name('import-students-excel');

    Route::delete('/students/delete/{id}', 'AdminController@delete_std')
    ->name('delete-student');

    Route::post('/students/toggle/{id}', 'AdminController@toggle_std')
    ->name('toggle-student');

    Route::get('/students/show/{id}', 'AdminController@show_individual_std')
    ->name('show-student');

    Route::patch('/students/show/{id}', 'AdminController@edit_std')
    ->name('edit-student');

    //lesson plan
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

    //study material
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

    //complaints
    Route::get('/students/complaints', 'AdminController@show_complaints')
    ->name('students-complaints');

    Route::get('/students/complaints-upload', 'AdminController@complaints_upload')
    ->name('students-complaints-upload');

    Route::post('/students/complaints-upload' , 'AdminController@upload_complaints_pdf')
    ->name('students-complaints-upload-pdf');

    Route::get('/download/complaints/{pdf}', 'AdminController@get_download_complaints')
    ->name('download-pdf-complaints');

    Route::delete('/delete-pdf-complaints/{pdf}/{id}', 'AdminController@delete_pdf_complaintsl')
    ->name('delete-pdf-complaints');

    //event routes
    Route::get('/events/show', 'AdminController@show_events')->name('show-events');
    Route::get('/events/create','AdminController@create')->name('create-events');
    Route::post('/events/create','AdminController@store')->name('store-event');

    //namaz timing routes
    Route::get('/namaz/create','AdminController@create_namaz_timing')
    ->name('add-namaz-timings');
    Route::post('/namaz/create','AdminController@store_namaz_timing')
    ->name('store-namaz-timings');

    Route::get('/namaz/view','AdminController@view_namaz_timing')
    ->name('view-namaz-timings');
    Route::get('/namaz/edit/{id}','AdminController@edit_namaz_timing')
    ->name('edit-namaz-timings');
    Route::patch('/namaz/edit/{namaz}','AdminController@store_edited_namaz_timing')
    ->name('store-namaz-timings-edit');

    //notification
    Route::get('/student/noticeboard/create','AdminController@create_noticeboaord')
    ->name('student-noticeboaord-create');
    Route::post('/student/notification/create','AdminController@store_noticeboaord')
    ->name('student-noticeboaord-store');

    Route::get('/student/notification/create','AdminController@create_notification')
    ->name('student-notification-create');

    Route::get('/student/notification/store','AdminController@store_notification')
    ->name('student-notification-store');

    //children
    Route::get('/childrens', 'AdminController@show_children')
    ->name('show-childrens');

    Route::get('/childrens/study-material', 'AdminController@show_children_study_material')
    ->name('show-childrens-study-material');

    Route::get('/childrens/lesson-plan', 'AdminController@show_children_lesson_plan')
    ->name('show-childrens-lesson-plan');

    //students pdf

    Route::get('/download/result/{pdf}', 'AdminController@getDownloadResult')
    ->name('download-pdf-result');

    Route::get('/download/invoice/{pdf}', 'AdminController@getDownloadInvoice')
    ->name('download-pdf-invoice');

    Route::get('/download/attendance/{pdf}', 'AdminController@getDownloadAttendance')
    ->name('download-pdf-attendance');

    Route::get('/download/datesheet/{pdf}', 'AdminController@getDownloadDatesheet')
    ->name('download-pdf-datesheet');

    Route::get('/download/dua/{pdf}', 'AdminController@getDownloadDua')
    ->name('download-pdf-dua');

    Route::get('/download/noticeboard/{pdf}', 'AdminController@getDownloadNoticeboard')
    ->name('download-pdf-noticeboard');


    //view students pdf

    Route::get('/view/pdf/{pdf}', 'AdminController@show_pdf')
    ->name('pdf');

    Route::get('/view/any-pdf/{pdf}', 'AdminController@show_pdf_path')
    ->name('show-pdf');

    //ajax request

    Route::get('/autocomplete-reg-no', 'AdminController@autocomplete')
    ->name('autocomplete');

});

//authentication routes
Auth::routes(['register' => false]);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')
->name('logout');

Route::get('/clear', function(){
	Artisan::call('config:clear');
	Artisan::call('cache:clear');
	Artisan::call('view:clear');
	Artisan::call('route:clear');
	Artisan::call('config:cache');
	return "Cache is cleared";
});