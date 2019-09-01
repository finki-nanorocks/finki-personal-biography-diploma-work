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
	
	/**
	 * Load page routes
	 */
	Route::get('/', function () {
		return redirect('home');
	});
	
	Route::get('/home', 'HomeController@index')
		->name('home');
	
	/**
	 * Overwrite routes for Auth::routes();
	 */
	Route::get('login', 'Auth\LoginController@showLoginForm')
		->name('login');
	
	Route::post('login', 'Auth\LoginController@login')
		->name('loginPost');
	
	Route::post('logout', 'Auth\LoginController@logout')
		->name('logout');
	
	/**
	 * FOR AUTH USERS ONLY
	 */
	Route::group(['middleware' => 'auth'], function () {
		
		/**
		 * ADMIN CRUD
		 */
		Route::get('/admin', 'AdminController@index')
			->name('adminPage');
		
		Route::get('/panel', 'AdminController@showManagerPanel')
			->name('panelShow');
		
		Route::post('/admin/login/user', 'AdminController@loginLikeUser')
			->name('loginUser');
		
		Route::post('/admin/delete/user', 'AdminController@deleteUser')
			->name('deleteUser');
		
		Route::post('/create/user', 'AdminController@createUser')
			->name('createUser');
		
		Route::get('/create/user', 'AdminController@createUser')
			->name('createUserLoadForm');
		
		Route::get('admin/categories', 'CategoriesController@show')
			->name('showCategories');
		
		Route::post('admin/categories', 'CategoriesController@createCategory')
			->name('createCategory');
		
		Route::post('admin/categories/delete', 'CategoriesController@deleteCategory')
			->name('deleteCategory');
		
		Route::get('admin/categories/edit/{id}', 'CategoriesController@editCategory')
			->name('editCategory');
		
		Route::post('admin/categories/update/{id}', 'CategoriesController@updateCategory')
			->name('updateCategory');
		
		/**
		 * PROFILE CRUD
		 */
		Route::get('/profile', 'ProfileController@index')
			->name('profileShow');
		
		Route::post('/upload/img', 'ProfileController@uploadImg')
			->name('imgUpload');
		
		/**
		 * PROFILE AJAX
		 */
		Route::post('profile/resume', 'AjaxController@editResume')
			->name('profileResume');
		
		Route::post('profile/info', 'AjaxController@editUserInfo')
			->name('profileInfo');
		
		Route::post('profile/password', 'AjaxController@updateUserPassword')
			->name('profilePassword');
		
		/**
		 * SUBJECTS CRUD
		 */
		Route::get('/subjects', 'SubjectsController@read')
			->name('subjectsRead');
		
		Route::get('/subjects/create', 'SubjectsController@create')
			->name('subjectsCreateShow');
		
		Route::post('/subjects/create', 'SubjectsController@create')
			->name('subjectsCreateStore');
		
		Route::get('/subjects/edit/{id}', 'SubjectsController@edit')
			->name('subjectsEdit');
		
		Route::post('/subjects/update/{id}', 'SubjectsController@update')
			->name('subjectsUpdate');
		
		Route::post('/subjects/delete/{id}', 'SubjectsController@delete')
			->name('subjectsDelete');
	});



