<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');

    /* Additional add drivers information */

    Route::delete('drivers/destroy', 'DriverController@massDestroy')->name('drivers.massDestroy');

    Route::resource('drivers', 'DriverController');

    /*     Additional Cab Information      */
    
    Route::delete('cabs/destroy', 'CabController@massDestroy')->name('cabs.massDestroy');

    Route::resource('cabs', 'CabController');

    /*   Additional Booking  Information     */
    
    Route::delete('bookings/destroy', 'BookingController@massDestroy')->name('bookings.massDestroy');

    Route::resource('bookings', 'BookingController');
    


});

Route::get('first-step',  'MapController@bookingrequestValidation');
Route::post('first-step', 'MapController@bookingrequestValidationStore')->name('firststep.store');
