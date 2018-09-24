<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

 /**
 * Admin area
 * roles & permissions hook:
 * \App\Http\Middleware\RoleMiddleware
 * \App\Providers\PermissionServiceProvider
 * RoleMiddleware: e.g. 'role:admin|editor,posts.delete|post.updates', etc.
 */
Route::group(['middleware' => ['auth', 'role:admin,']], function () {		

	Route::prefix('admin')->group(function () {

		Route::get('/', function () {			
			return view('layouts.admin.master');
		});

		Route::put('/users/update', function () {
			$user = request()->user;
			// dd($user);

		});

		Route::resource('/users', 'UserController');
		Route::resource('/roles', 'RoleController');

		Route::resource('/permissions', 'PermissionController');		
		Route::get('/permissions', 'PermissionController@index');
		Route::delete('/permissions', 'PermissionController@bulkDelete');

		Route::get('/site', function () {
			return view('layouts.admin.master');
		});

	});	
});

Route::get('/home', 'HomeController@index')->name('home');
