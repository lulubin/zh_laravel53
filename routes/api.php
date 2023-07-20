<?php

Route::get('/topics', 'TopicsController@index')->middleware('api');

Route::post('/questions/follower', 'QuestionFollowController@follower')->middleware('auth:api');
Route::post('/questions/follow', 'QuestionFollowController@followThisQuestion')->middleware('auth:api');

Route::post('/user/follower', 'FollowersController@index')->middleware('auth:api');
Route::post('/user/follow', 'FollowersController@follow')->middleware('auth:api');

Route::post('/answer/voter', 'VotesController@index')->middleware('auth:api');
Route::post('/answer/vote', 'VotesController@vote')->middleware('auth:api');

Route::post('/message/store', 'MessagesController@store')->middleware('auth:api');

Route::post('/comments', 'CommentsController@index');
Route::post('/comment/store', 'CommentsController@store')->middleware('auth:api');
