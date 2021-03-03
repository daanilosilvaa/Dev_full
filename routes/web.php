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

/**
     * Routes People
     */
    Route::any('people/search', 'Admin\PeopleController@search')->name('people.search');
    Route::resource('/people', 'Admin\PeopleController');

    /**
     * Routes Address
     */
    Route::any('addresses/search', 'Admin\AddressController@search')->name('address.search');
    Route::any('/people/{idPeople}/address/create', 'Admin\AddressController@create')->name('people.address.create');
    Route::post('/people/{idPeople}/address/store', 'Admin\AddressController@store')->name('address.store');
    Route::put('/people/{idPeople}/address/{idAddress}/update', 'Admin\AddressController@update')->name('address.update');
    Route::get('/people/{idPeople}/address/{idAddress}/edit', 'Admin\AddressController@edit')->name('address.edit');
    Route::any('/people/{idPeople}/address/{idAddress}/show', 'Admin\AddressController@show')->name('address.show');
    Route::delete('/people/{idPeople}/address/{idAddress}/destroy', 'Admin\AddressController@destroy')->name('address.destroy');
    Route::get('/people/{idPeople}/address/index', 'Admin\AddressController@index')->name('address.index');


    /**
     * Routes Phones
     */
    Route::any('phones/search', 'Admin\PhoneController@search')->name('phone.search');
    Route::any('/people/{idPeople}/phone/create', 'Admin\PhoneController@create')->name('people.phone.create');
    Route::post('/people/{idPeople}/phone/store', 'Admin\PhoneController@store')->name('phone.store');
    Route::put('/people/{idPeople}/phone/{idPhone}/update', 'Admin\PhoneController@update')->name('phone.update');
    Route::get('/people/{idPeople}/phone/{idPhone}/edit', 'Admin\PhoneController@edit')->name('phone.edit');
    Route::any('/people/{idPeople}/phone/{idPhone}/show', 'Admin\PhoneController@show')->name('phone.show');
    Route::delete('/people/{idPeople}/phone/{idPhone}/destroy', 'Admin\PhoneController@destroy')->name('phone.destroy');
    Route::get('/people/{idPeople}/phone/index', 'Admin\PhoneController@index')->name('phone.index');
