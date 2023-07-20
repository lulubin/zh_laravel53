<?php
Route::get('/', ['as'=>'home','uses'=>'QuestionsController@index']);
Route::get('/home', 'HomeController@index');

Auth::routes();

Route::resource('questions', 'QuestionsController');
Route::post('questions/{question}/answer','AnswersController@store');
Route::get('question/{question}/follow', 'QuestionFollowController@follow');

Route::get('email/verify/{token}',['as'=>'email.verify','uses'=>'EmailController@verify']);

Route::get('notifications', 'NotificationsController@index');