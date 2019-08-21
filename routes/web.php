<?php
Route::post('/deleteTempImage', 'PostController@deleteTempImage');
Route::post('image-upload', 'PostController@imageUploadPost');

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::get('/backroom', 'BackroomController@index')->name('backroom');
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');
Route::resource('categories','CategoriesController');


//under construction
Route::group(['middleware' => 'under-construction'], function () {

});