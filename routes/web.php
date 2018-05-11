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

Route::get('/', 'HomeController@index')->name('index');
Route::post('/category/set', 'HomeController@setCategory')->name('category.set');

Route::get('/app/{id}', 'HomeController@app')->name('app');

Route::resource('applications', 'AppsController');
Route::post('/applications/search', 'AppsController@search')->name('applications.search');
Route::post('/applications/storeApp', 'AppsController@storeApp')->name('applications.storeApp');

Route::prefix('admin')->group(function() {
    Route::get('/login',
        'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
}) ;


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/apps/ok', 'AppsController@uploadefile')->name('fileuploade');

Route::resource('categories', 'CategoryController');

Route::get('/kepek/{id}','HomeController@getImages');

Route::resource('rates', 'RateController');
Route::post('/sendrate', 'RateController@saveRating')->name('rating.send');

Route::resource('admins', 'AdminsController');

Route::resource('users', 'UsersController');
Route::get('/developpers', 'UsersController@developpers')->name('users.developpers');
Route::get('/settings', 'UsersController@settings')->name('users.settings');
Route::get('/userapps', 'UsersController@userapps')->name('users.userapps');
Route::post('/setDevelopper', 'UsersController@setDevelopper')->name('users.setDevelopper');
Route::post('/updade_u', 'UsersController@update')->name('users.updat');

Route::get('/developpers/index', 'HomeController@uploade')->name('apps.uploade');