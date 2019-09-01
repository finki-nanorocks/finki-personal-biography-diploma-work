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
	
	/**
	 * Categories routes for API
	 */
	Route::get('/categories', 'ApiController@showCategories')
		->name('categoriesShow');
	
	Route::get('/categories/{id}', 'ApiController@showCategory')
		->name('categoryOne');
	
	Route::get('/categories/{id}/users', 'ApiController@showUsersPerCategory')
		->name('showCategoryUsers');
	
	/**
	 * User routes for API
	 */
	Route::get('/users', 'ApiController@showUsers')
		->name('showAllUsers');
	
	Route::get('/users/{id}', 'ApiController@showUser')
		->name('showOneUser');
	
	Route::get('/users/{id}/subjects', 'ApiController@showSubjectsPerUser')
		->name('showUserSubjects');
	
	Route::get('/users/{id}/category', 'ApiController@showUserCategory')
		->name('showUserCategory');


