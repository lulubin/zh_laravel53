<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/topics', function (Request $request) {
    return \App\Topic::select(['id','name'])
        ->where('name','like','%'.$request->query('q').'%')
        ->get();
})->middleware('api');

Route::post('/questions/follower', function (Request $request) {
    $user = \Auth::guard('api')->user();
    $followed = $user->followed($request->get('question'));
    return response()->json(['followed' => $followed]);
})->middleware('auth:api');

Route::post('/questions/follow', function (Request $request) {
    $user = \Auth::guard('api')->user();
    $followed = $user->followsThis($request->get('question'));
    $question = \App\Question::find($request->get('question'));
    if(count($followed['detached']) > 0){
        $followed = false;
        $question->decrement('followers_count');
    }else{
        $followed = true;
        $question->increment('followers_count');
    }
    return response()->json(['followed' => $followed]);
})->middleware('auth:api');

Route::post('/user/follower', 'FollowersController@index')->middleware('auth:api');
Route::post('/user/follow', 'FollowersController@follow')->middleware('auth:api');

Route::post('/answer/voter', 'VotesController@index')->middleware('auth:api');
Route::post('/answer/vote', 'VotesController@vote')->middleware('auth:api');

Route::post('/message/store', 'MessagesController@store')->middleware('auth:api');

Route::post('/comments', 'CommentsController@index');
Route::post('/comment/store', 'CommentsController@store')->middleware('auth:api');
