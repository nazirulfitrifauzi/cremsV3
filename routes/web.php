<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    // Profile
    Route::get('/profile/{profile}', 'HomeController@profile')->name('profile');
    Route::patch('/profile-update/{profile}', 'HomeController@updateProfile')->name('profile.update');

    /** Human Resources **/
    Route::group(['middleware' => ['staff']], function () {
        // Attendances
        Route::get('/hr/attendance', 'HR\AttendanceController@index')->name('attendances.index');
        Route::post('/hr/attendance-store', 'HR\AttendanceController@store')->name('attendances.store');
        // Leaves
        Route::resource('/hr/leave', 'HR\LeaveController');
        Route::patch('/hr/leave/approve/{leave}', 'HR\LeaveController@approve')->name('leave.approve');
        Route::patch('/hr/leave/reject/{leave}', 'HR\LeaveController@reject')->name('leave.reject');
        Route::get('/hr/leave-calendar', 'HR\LeaveController@calendar')->name('leave.calendar');
        // Claims
        Route::resource('/hr/claim', 'HR\ClaimController');
        Route::patch('/hr/claim/approve/{claim}', 'HR\ClaimController@approve')->name('claim.approve');
        Route::patch('/hr/claim/reject/{claim}', 'HR\ClaimController@reject')->name('claim.reject');
    });

    /** Sys Admin */
    Route::group(['middleware' => ['sysAdmin']], function () {
        // Roles
        Route::resource('/roles', 'Admin\RolesController');
        // New Request
        Route::get('/new-request', 'Admin\RequestController@index')->name('request.index');
        Route::patch('/new-request/{request}', 'Admin\RequestController@update')->name('request.update');
    });
});
