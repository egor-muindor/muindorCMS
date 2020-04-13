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

Route::get('/mc-backup', 'MinecraftController@main')->name('mc-backup.view');
Route::post('/mc-backup/login', 'MinecraftController@login')->name('mc-backup.login');
Route::view('/{any}', 'welcome')->where('any', '.*');
