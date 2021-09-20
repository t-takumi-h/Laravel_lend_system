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

Route::get('/', 'TablesController@showTables')->name('top');
Route::get('/tables/{table}', 'ItemsController@showItems')->name('item.list');
Route::get('/tables/{table}/items/{item}/', 'ItemsController@showItemDetail')->name('item.detail');
Route::get('/tables/{table}/lent', 'LendItemController@showLendingItems')->name('item.lend-list');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/create', 'TablesController@showTableCreationForm')->name('table.create');
    Route::post('/create', 'TablesController@createTable')->name('table.create');
    Route::post('/tables/{table}/items/{item}/', 'ItemsController@lendItem')->name('item.detail');
    Route::get('/return', 'ReturnController@showReturnForm')->name('return');
    Route::post('/return', 'ReturnController@returnItem')->name('return');
});

Route::middleware(['auth', 'can:itemCreate,table'])->group(function () {
    Route::get('/tables/{table}/create', 'ItemsController@showItemCreationForm')->name('item.create');
    Route::post('/tables/{table}/create', 'ItemsController@createItem')->name('item.create');
    Route::get('/tables/{table}/items/{item}/edit', 'ItemsController@showItemEditingForm')->name('item.edit');
    Route::post('/tables/{table}/items/{item}/edit', 'ItemsController@editItem')->name('item.edit');
});
