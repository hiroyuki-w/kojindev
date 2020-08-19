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

//トップページ
Route::get('/', 'TopController@index')->name('top');

//SNSログイン関連
Route::group(['namespace' => 'Social'], function () {
    Route::get('/social/login/{provider}', 'LoginController@login')->name('social.login');
    Route::get('/social/login/{provider}/callback', 'LoginController@callback')->name('social.callback');
    Route::get('/social/logout', 'LoginController@logout')->name('logout');
});

//会員登録、会員情報変更
Route::group(['namespace' => 'Auth', 'middleware' => 'isLogin'], function () {
    Route::get('/auth/user/edit', 'UserController@edit')->name('user.edit');
    Route::post('/auth/user/store', 'UserController@store')->name('user.store');
    Route::get('/auth/user/complete', 'UserController@complete')->name('user.complete');
});

//アプリケーション関連
Route::group(['namespace' => 'Application'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/application/create', 'ApplicationController@create')->name('application.create');
        Route::get('/application/{trApplication}/edit', 'ApplicationController@edit')->name('application.edit');

        Route::post('/application/{trApplication?}', 'ApplicationController@store')->name('application.store');

        Route::get('/application/complete', 'ApplicationController@complete')->name('application.complete');

        Route::patch('/application/{trApplication}/toggle-public',
            'ApplicationController@togglePublicFlg')->name('application.togglePublicFlg');
        Route::delete('/application/{trApplication}/delete',
            'ApplicationController@delete')->name('application.delete');
        Route::post('/application/{trApplication}/comment/',
            'CommentController@store')->name('application.comment.store');
        Route::get('/application/comment/complete', 'CommentController@complete')->name('application.comment.complete');
        Route::get('/application/{trApplication}/report/create',
            'ReportController@create')->name('application.report.create');
        Route::post('/application/{trApplication}/report/',
            'ReportController@store')->name('application.report.store');
        Route::get('/application/report/complete',
            'ReportController@complete')->name('application.report.complete');
    });
    Route::get('/application/{trApplication}', 'ApplicationController@show')->where('trApplication', '[0-9]+')->name('application.show');
    Route::get('/application/search/{tag?}', 'ApplicationController@search')->name('application.search');

});

//フィードバック
Route::group(['namespace' => 'Application\Feedback'], function () {
    Route::get('/application/feedback/{trFeedback}', 'FeedbackController@show')->where('trFeedback', '[0-9]+')->name('feedback.show');
    Route::get('/application/{trApplication}/feedbacklist', 'FeedbackController@list')->name('application.feedbacklist');
    Route::group(['middleware' => 'auth'], function () {
        Route::post('/application/feedback/{trFeedback}/comment/', 'CommentController@store')->name('feedback.comment.store');
        Route::get('/application/feedback/comment/complete', 'CommentController@complete')->name('feedback.comment.complete');
        Route::get('/application/{trApplication}/feedback/edit/{trFeedback?}', 'FeedbackController@edit')->name('feedback.edit');
        Route::post('/application/{trApplication}/feedback/store/{trFeedback?}', 'FeedbackController@store')->name('feedback.store');
        Route::get('/application/feedback/complete', 'FeedbackController@complete')->name('feedback.complete');
        Route::delete('/application/feedback/delete/{trFeedback}', 'FeedbackController@delete')->name('feedback.delete');
    });

});


//ユーザページ
Route::get('/user/{trUser}/', 'UserController@detail')->where('trUser', '[0-9]+')->name('user.detail');
Route::get('/user/search/{keyword?}', 'UserController@search')->name('user.search');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/me/', function () {
        return redirect()->route('user.detail', ['trUser' => Auth::id()]);
    })->name('user.me');
});
//ビューのみのページ
Route::view('/login', 'login')->name('login');
Route::view('/userpolicy', 'userpolicy')->name('userpolicy');







