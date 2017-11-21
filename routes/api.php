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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::get('cat-most-used', 'API\MasterController@catMostUsed')->name('cat-most-used');
    //------Namespace API\V1---------//
    Route::namespace('API\V1')->group(function () {
        Route::middleware('auth:api')->group(function () {
            Route::resource('comments', 'CommentsController', ['only' => 'destroy']);
            Route::resource('posts.comments', 'PostCommentsController', ['only' => 'store']);
        });
        Route::resource('tag', 'TagController', ['only' => ['index', 'store', 'update']]);
        Route::resource('category', 'CategoryController', ['only' => ['index', 'store', 'update']]);
        Route::resource('posts.comments', 'PostCommentsController', ['only' => ['index', 'store']]);
        Route::resource('comments', 'CommentsController', ['only' => ['index', 'show']]);
        Route::get('users/{user}/comments', 'UsersController@comments');
        Route::resource('posts', 'PostsController', ['only' => ['index', 'show']]);
        Route::resource('articles', 'ArticlesController', ['only' => ['index', 'show']]);
        Route::get('users/{user}/posts', 'UsersController@posts')->name('users.posts.index');
        Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'update', 'destroy']]);
        Route::delete('media-library/drop/{filename}', 'MediaLibraryController@destroyDropZoneUpload')->name('media-library.drop');
        Route::resource('media-library', 'MediaLibraryController');
        Route::resource('dashboard', 'DashboardController', ['only' => 'index']);
    });
});

Route::prefix('v2')->name('api.v2.')->group(function () {
    Route::namespace('API\V2')->group(function () {
        Route::resource('posts', 'PostController', ['only' => ['index']]);
    });
});
