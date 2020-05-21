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

    /** Human Resources **/
    Route::group(['middleware' => ['staff']], function () {
        // Attendances
        Route::get('/hr/attendance', 'HR\AttendanceController@index')->name('attendances.index');
        Route::post('/hr/attendance-store', 'HR\AttendanceController@store')->name('attendances.store');
        // Leaves
        Route::get('/hr/leave', 'HR\LeaveController@index')->name('leaves.index');
        Route::get('/hr/leave/calendar', 'HR\LeaveController@calendar')->name('leaves.calendar');
    });

    // Sys Admin
    Route::group(['middleware' => ['sysAdmin']], function () {
        Route::resource('/roles', 'Admin\RolesController');
    });
});
