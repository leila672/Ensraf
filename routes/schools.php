<?php
Route::group(['prefix' => 'schools', 'as' => 'schools.', 'namespace' => 'Schools', 'middleware' => ['auth','schools']], function () {


    Route::get('/', 'HomeController@index')->name('home');

    //students
    Route::delete('students/destroy', 'StudentsController@massDestroy')->name('students.massDestroy');
    Route::post('students/media', 'StudentsController@storeMedia')->name('students.storeMedia');
    Route::post('students/ckmedia', 'StudentsController@storeCKEditorImages')->name('students.storeCKEditorImages');
    Route::resource('students', 'StudentsController');

    // My Parents
    Route::delete('my-parents/destroy', 'MyParentsController@massDestroy')->name('my-parents.massDestroy');
    Route::resource('my-parents', 'MyParentsController');
    
    //screens
    Route::get('screen','ScreensController@index')->name('screens.index');
});
