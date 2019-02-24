<?php
Route::group([
    'middleware' => 'api',
], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');
    Route::post('createEvent', 'calendareventsController@createEvent');
    Route::get('geteventsList', 'calendareventsController@getEventsList');
    Route::post('deleteevent', 'calendareventsController@deleteevent');
    Route::post('updateevent', 'calendareventsController@updateevent');
    // getEventsList
    Route::get('getusers', 'usersdataController@users');
    Route::post('updateuser', 'usersdataController@updateuser');
    // deleteuser
    Route::post('deleteuser', 'usersdataController@deleteuser');
    Route::get('getadminusers', 'usersdataController@getadminusers');

});
