<?php
Route::get('/', ['as'=>'home','uses'=>'QuestionsController@index']);
Route::get('/home', 'HomeController@index');

Auth::routes();

Route::resource('questions', 'QuestionsController');
Route::post('questions/{question}/answer','AnswersController@store');
Route::get('question/{question}/follow', 'QuestionFollowController@follow');

Route::get('email/verify/{token}',['as'=>'email.verify','uses'=>'EmailController@verify']);

Route::get('notifications', 'NotificationsController@index');
Route::get('notifications/{notification}', 'NotificationsController@show');

Route::get('inbox', 'InboxController@index');
Route::get('inbox/{dialogId}', 'InboxController@show');
Route::post('inbox/{dialogId}/store', 'InboxController@store');

Route::get('avatar', 'UsersController@avatar');
Route::post('avatar', 'UsersController@changeAvatar');

Route::get('password', 'PasswordController@password');
Route::post('password', 'PasswordController@update');

Route::get('setting', 'SettingController@index');
Route::post('setting', 'SettingController@store');