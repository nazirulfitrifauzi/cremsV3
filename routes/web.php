<?php

use App\Models\StaffInfo;
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
    // Profile
    Route::get('/profile/{profile}', 'HomeController@profile')->name('profile');
    Route::patch('/profile-update/{profile}', 'HomeController@updateProfile')->name('profile.update');

    Route::group(['middleware' => ['profile']], function () {
        /** Dashboard */
        Route::get('/home', 'HomeController@index')->name('home');
        /** Human Resources **/
        Route::group(['middleware' => ['staff']], function () {
            // Staff
            Route::resource('/hr/staff', 'HR\StaffController')->middleware('hr');
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
    });

    /** Sys Admin */
    Route::group(['middleware' => ['sysAdmin']], function () {
        // Roles
        Route::resource('/ual', 'Admin\UALController');
        // New Request
        Route::get('/new-request', 'Admin\RequestController@index')->name('request.index');
        Route::patch('/new-request/{request}', 'Admin\RequestController@update')->name('request.update');
    });
});
