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
    return view('welcome');
});

Auth::routes();

Route::get('/forum', 'ForumsConteroller@index')->name('forum');
Route::get('channel/{slug}', 'ForumsConteroller@channel')->name('channel');
Route::get('{provider}/auth',[
    'uses'=>'SocialsController@auth',
    'as'=>'social.auth'
]);

Route::get('{provider}/redirect',[
    'uses'=>'SocialsController@auth_callback',
    'as'=>'social.auth_callback'
]);
Route::get('discussion/{slug}',[
    'uses'=>'DiscussionController@show',
    'as'=>'discussion.show'
]);

Route::group(['middleware'=>'auth'],function (){
    Route::resource('channels','ChannelsController');
    Route::get('discuss/create',[
        'uses'=>'DiscussionController@create',
        'as'=>'discussion.create'
    ]);
    Route::post('discuss/store',[
        'uses'=>'DiscussionController@store',
        'as'=>'discussion.store'
    ]);

    Route::post('discuss/reply/{id}',[
        'uses'=>'DiscussionController@reply',
        'as'=>'discussion.reply'
    ]);
    Route::get('/reply/like/{id}',[
        'uses'=>'RepliesController@like',
        'as'=>'reply.like'
    ]);
    Route::get('/reply/unlike/{id}',[
        'uses'=>'RepliesController@unlike',
        'as'=>'reply.unlike'
    ]);
    Route::get('/discussion/watch/{id}',[
        'uses'=>'WatcherController@watch',
        'as'=>'discussion.watch'
    ]);
    Route::get('/discussion/unwatch/{id}',[
        'uses'=>'WatcherController@unwatch',
        'as'=>'discussion.unwatch'
    ]);
    Route::get('/reply/bestAnswer/{id}',[
        'uses'=>'RepliesController@bestAnswer',
        'as'=>'reply.bestAnswer'
    ]);
    Route::post('discuss/update/{id}',[
        'uses'=>'DiscussionController@update',
        'as'=>'discussion.update'
    ]);
    Route::get('discuss/edit/{id}',[
        'uses'=>'DiscussionController@edit',
        'as'=>'discussion.edit'
    ]);
    Route::post('reply/update/{id}',[
        'uses'=>'RepliesController@update',
        'as'=>'reply.update'
    ]);
    Route::get('reply/edit/{id}',[
        'uses'=>'RepliesController@edit',
        'as'=>'reply.edit'
    ]);


});