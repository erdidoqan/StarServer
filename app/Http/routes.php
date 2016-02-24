<?php


//use Illuminate\Routing\Route;


Route::post('login', 'HomeController@postLogin');


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');
    Route::post('/addNewCategory', 'DashboardController@postAddNewCategory');
    Route::post('/addNewMenu', 'DashboardController@postAddNewMenu');
});
