<?php

Route::group(['prefix' => 'v1/user', 'as' => 'api.', 'namespace' => 'Api\V1\User'], function () {

    Route::post('login','UserAuthApiController@login'); 
    
    Route::group(['middleware' => ['auth:sanctum']],function () {

        Route::post('fcm-token','UsersApiController@update_fcm_token');
        
        //user profile
        Route::group(['prefix' =>'profile'],function(){
            Route::get('/','UsersApiController@profile');
            Route::post('update','UsersApiController@update');
            Route::post('update_password','UsersApiController@update_password');
        }); 

        // call
        Route::get('call','CallController@call');
        
        // notifications
        Route::get('notifications','NotificationsApiController@index');

    });
});
