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

Route::get('media/news/{id}/{filename}', function ($id, $filename) {
	$path = storage_path('app/public/uploads/posts/' . $id . '/' . $filename);
	if (!File::exists($path)) {
		abort(404);
	}
	$file = File::get($path);
	$type = File::mimeType($path);
	$response = Response::make($file, 200);
	$response->header("Content-Type", $type);
	return $response;
})->name('media.posts.path');

Route::namespace('Auth')->group(function () {
// Auth::routes();
// Authentication Routes...
	Route::get('login', 'LoginController@showLoginForm')->name('login');
	Route::post('login', 'LoginController@login');
	Route::post('logout', 'LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'RegisterController@register');

// Password Reset Routes...
	Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'ResetPasswordController@reset');
});

Route::prefix('admin')->name('admin.')->namespace('Admin')
	->group(function () {
		Route::resource('media-library', 'MediaLibraryController');
		Route::middleware(['auth', 'role:superadministrator|administrator|editor|supporter'])->group(function () {
			//Dashboard and profile
			Route::middleware(['permission:read-dashboard'])->group(function () {
				Route::get('/', 'HomeController@index')->name('index');
				Route::get('dashboard', 'HomeController@index')->name('dashboard');
			});
			Route::prefix('profile')->name('profile.')->namespace('Manage')
				->middleware(['permission:read-profile|update-profile'])
				->group(function () {
					Route::get('edit', 'UserController@editProfile')->name('edit');
					Route::resource('user', 'ProfileController', ['only' => ['index', 'edit', 'update']]);
				});
			//Settings section
			Route::middleware(['permission:create-settings|read-settings|update-settings|delete-settings'])->group(function () {
				Route::patch('settings/ajax/{id}', 'SettingController@ajaxUpdate')->name('settings.ajax');
				Route::resource('settings', 'SettingController', ['only' => ['index', 'edit', 'update']]);
			});
			//Manage section
			Route::prefix('manage')->name('manage.')->namespace('Manage')
				->middleware(['permission:create-manages|read-manages|update-manages|delete-manages'])
				->group(function () {
					Route::resource('user', 'UserController');
					Route::middleware(['permission:create-acl|read-acl|update-acl|delete-acl'])
						->group(function () {
							Route::resource('role', 'RoleController');
							Route::resource('permission', 'PermissionController');
						});
				});
			//References data
			Route::prefix('ref')->name('ref.')->namespace('Ref')
				->middleware(['permission:create-refs|read-refs|update-refs|delete-refs'])
				->group(function () {
					Route::resource('category', 'CategoryController');
					Route::patch('category/status/{id}', 'CategoryController@updateStatus');
					Route::resource('tag', 'TagController');
					Route::resource('page', 'PageController');
				});
			//Articles section
			Route::middleware(['permission:create-posts|read-posts|update-posts|delete-posts'])->group(function () {
				Route::get('draft/article', 'ArticleController@draft')->name('article.draft');
				Route::resource('article', 'ArticleController');
			});
			//Advertise section
			Route::middleware(['permission:create-ads|read-ads|update-ads|delete-ads'])->group(function () {
				Route::get('advertise/active', 'AdvertiseController@active')->name('advertise.active');
				Route::get('advertise/expired', 'AdvertiseController@expired')->name('advertise.expired');
				Route::resource('advertise', 'AdvertiseController');
				Route::resource('advertise-type', 'AdvertiseTypeController');
			});
			Route::get('/insert-db', 'HomeController@insertPostCategory');
			Route::get('clear-cache', 'ConfigController@clearCache')->name('cache.clear');
			Route::get('config-clear', 'ConfigController@configClear')->name('config.clear');
			Route::get('config-cache', 'ConfigController@configCache')->name('config.cache');
		});
	});

//-------------Blog Front Route-------------//
Route::name('blog.')->namespace('Blog')->middleware('web')->group(function () {
	Route::get('/', 'HomeController@index')->name('index');
	Route::get('/search', 'HomeController@searchArticle')->name('search');
	Route::get('/files/{filename}', 'MediaController@getFile')->name('files');
	Route::get('/media/{filename}', 'MediaController@getFiles')->name('media');
	Route::resource('article', 'PostsController', ['only' => 'show']);
	Route::resource('topics', 'CategoryController', ['only' => 'show']);
	Route::resource('tag', 'TagController', ['only' => 'show']);
	Route::resource('page', 'PageController', ['only' => 'show']);
	Route::resource('contact', 'ContactController', ['only' => ['index', 'store']]);
	//Sitemap
	Route::get('/sitemap.html', 'SitemapController@index')->name('sitemap.html');
	Route::get('/sitemap/posts', 'SitemapController@posts')->name('sitemap.posts');
	Route::get('/sitemap/categories', 'SitemapController@categories')->name('sitemap.categories');
	Route::get('mail', function () {
		return new App\Mail\AutoReply();
	});
});
