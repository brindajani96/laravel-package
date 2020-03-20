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

Route::get('/', function () {
    return view('welcome')->middleware('authenticated');
})->middleware('authenticated');
//View Page//

Route::get('/index', 'productcurdcontroller@index')->middleware('authenticated');
//add Data//
Route::get('/add', 'productcurdcontroller@create')->middleware('authenticated');
//Save Data//
Route::post('/saveData', 'productcurdcontroller@store')->middleware('authenticated');
//Edit Data//
Route::get('/edit/{productId}', 'productcurdcontroller@edit')->middleware('authenticated');
//Update Data//
Route::put('updateData/{productId}', 'productcurdcontroller@update')->middleware('authenticated');
//Delete Data//
Route::get('/delete/{productId}', 'productcurdcontroller@delete')->middleware('authenticated');
//Subcategory fetch data//
Route::get('subcategory/{categoryID}', 'productcurdcontroller@fetchdata');



//image upload//
Route::get('/ajax_upload', 'AjaxUploadController@index');
Route::post('/ajax_upload/action', 'AjaxUploadController@action')->name('ajaxupload.action');

////user verfication//
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
