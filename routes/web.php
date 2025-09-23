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

// front page route

Route::get('/', 'Front\WebController@index');
Route::get('/about', 'Front\WebController@about')->name('about');
Route::get('/gallery', 'Front\WebController@gallery')->name('gallery');
Route::get('/services', 'Front\WebController@services')->name('services');
Route::get('/employees', 'Front\WebController@employees')->name('employees');
Route::get('/contact', 'Front\WebController@contact')->name('contact');
Route::get('/career', 'Front\WebController@career')->name('career');
Route::get('/get-states', 'Front\WebController@getStates')->name('get-states');
Route::get('/get-districts/{stateId}', 'Front\WebController@getDistricts')->name('get-districts');

Route::get('/company1 ', 'Front\WebController@company')->name('company1');
Route::post('career-application', 'Front\WebController@careerApply')->name('career.application');
Route::get('job/{id}/{slug?}', 'Front\WebController@jobDetails')->name('job.details');
Route::post('job-application', 'Front\WebController@jobApply')->name('job.application');

// front page route

Route::get('login', 'User\LoginController@index');
Route::post('login', 'User\LoginController@Auth');

Route::get('mail', 'User\HomeController@mail');

Route::group(['middleware' => ['preventbackbutton', 'auth']], function () {

    Route::get('dashboard', 'User\HomeController@index');
    Route::get('profile', 'User\HomeController@profile');
    Route::get('logout', 'User\LoginController@logout');
    Route::resource('user', 'User\UserController', ['parameters' => ['user' => 'user_id']]);
    Route::resource('userRole', 'User\RoleController', ['parameters' => ['userRole' => 'role_id']]);
    Route::resource('rolePermission', 'User\RolePermissionController', ['parameters' => ['rolePermission' => 'id']]);
    Route::post('rolePermission/get_all_menu', 'User\RolePermissionController@getAllMenu');
    Route::resource('changePassword', 'User\ChangePasswordController', ['parameters' => ['changePassword' => 'id']]);
});

Route::get('reset-password-user', 'ResetPasswordController@index')->name('reset.password');
Route::post('reset-password-user', 'ResetPasswordController@sendResetLink')->name('reset.password');
Route::get('enter-password', 'ResetPasswordController@enterPassword')->name('reset.password.enter');
Route::post('enter-password', 'ResetPasswordController@store')->name('reset.password.enter');

Route::get('local/{language}', function ($language) {

    session(['my_locale' => $language]);

    return redirect()->back();
});
