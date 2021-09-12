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

Route::get('/','TablesController@showTables')->name('top');
Route::get('/tables/{table}','ItemsController@showItems')->name('item.list');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){
    Route::get('/create', 'TablesController@showTableCreationForm')->name('table.create');
    Route::post('/create', 'TablesController@createTable')->name('table.create');
    Route::get('/tables/{table}/create', 'ItemsController@showItemCreationForm')->name('item.create');
    Route::post('/tables/{table}/create', 'ItemsController@createItem')->name('item.create');
});
