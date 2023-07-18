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

Route::get('/', ['as'=>'home','uses'=>'QuestionsController@index']);

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('questions', 'QuestionsController');

Route::get('email/verify/{token}',['as'=>'email.verify','uses'=>'EmailController@verify']);

Route::post('questions/{question}/answer','AnswersController@store');

Route::get('question/{question}/follow', 'QuestionFollowController@follow');

Route::get('notifications', 'NotificationsController@index');
