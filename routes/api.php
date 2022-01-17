<?php

Route::group(['prefix' => 'v1/user', 'as' => 'api.', 'namespace' => 'Api\V1\User', 'middleware' => 'changelanguage'], function () {

    Route::post('login','UserAuthApiController@login'); 
    Route::post('register','UserAuthApiController@register'); 
    
    Route::get('cities','SettingsApiController@cities'); 
    
    //forgetpassword
    Route::post('forgetpassword','ForgetPasswordController@create_token');
    Route::post('forgetpassword/reset','ForgetPasswordController@reset');
    
    Route::group(['middleware' => ['auth:sanctum']],function () {

        Route::post('fcm-token','UsersApiController@update_fcm_token');
        
        //user profile
        Route::group(['prefix' =>'profile'],function(){
            Route::get('/','UsersApiController@profile');
            Route::post('update','UsersApiController@update');
            Route::post('update_password','UsersApiController@update_password');
            Route::post('update_voice','UsersApiController@update_voice');
        }); 

        // call
        Route::get('call/{id}','CallController@call');
        
        // notifications
        Route::get('notifications','NotificationsApiController@index');

    });
});
