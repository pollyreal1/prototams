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


Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => ['cors']], function (){

    Route::post('Schedule-create', 'ScheduleController@store');
    Route::get('Schedule-index', 'ScheduleController@index');
    Route::post('Schedule-update', 'ScheduleController@update');
    Route::get('Schedule-show', 'ScheduleController@show');


    Route::post('UserSchedule-store', 'UserScheduleController@store');
    Route::get('UserSchedule-index', 'UserScheduleController@index');
    Route::post('UserSchedule-update', 'UserScheduleController@update');
    Route::get('UserSchedule-show', 'UserScheduleController@show');

    Route::get('ts', 'TimesheetController@index');
    Route::get('ts/add', 'TimesheetController@store');
});
