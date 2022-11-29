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
Route::group(['middleware' => 'preventBackHistory'],function(){
	Route::get('/', 'HomeController@welcome')->name('welcome');
	Route::get('admin','Admin\Auth\LoginController@showLoginForm')->name('admin.showLoginForm');
	Route::get('admin/login','Admin\Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('admin/login', 'Admin\Auth\LoginController@login');
	Route::get('admin/resetPassword','Admin\Auth\PasswordResetController@showPasswordRest')->name('admin.resetPassword');
	Route::post('admin/sendResetLinkEmail', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.sendResetLinkEmail');
	Route::get('admin/find/{token}', 'Admin\Auth\PasswordResetController@find')->name('admin.find');
	Route::post('admin/create', 'Admin\Auth\PasswordResetController@create')->name('admin.sendLinkToUser');
	Route::post('admin/reset', 'Admin\Auth\PasswordResetController@reset')->name('admin.resetPassword_set');
	Route::group(['prefix' => 'admin','middleware'=>'Admin','namespace' => 'Admin','as' => 'admin.'],function(){
		Route::get('/dashboard','MainController@dashboard')->name('dashboard');
		Route::get('/logout','Auth\LoginController@logout')->name('logout');

		//====================> Update Admin Profile <====================
		Route::get('/profile','UsersController@updateProfile')->name('profile');
		Route::post('/updateProfileDetail','UsersController@updateProfileDetail')->name('updateProfileDetail');
		Route::post('/updatePassword','UsersController@updatePassword')->name('updatePassword');

		//====================> Role Management <====================
		Route::get('/role','RoleController@index')->name('role.index');
		Route::get('/role/edit/{id}','RoleController@edit')->name('role.edit');
		Route::post('/role/update','RoleController@update')->name('role.update');
		Route::get('/role/show','RoleController@show')->name('role.show');

		//====================> CMS Management <====================
		Route::get('/cms','CmsController@index')->name('cms.index');
		Route::get('/cms/create','CmsController@create')->name('cms.create');
		Route::post('/cms/store','CmsController@store')->name('cms.store');
		Route::get('/cms/edit/{id}','CmsController@edit')->name('cms.edit');
		Route::post('/cms/update/{id}','CmsController@update')->name('cms.update');
		Route::post('/cms/delete/{id}','CmsController@delete')->name('cms.delete');
		Route::get('/cms/show','CmsController@show')->name('cms.show');

	});
});