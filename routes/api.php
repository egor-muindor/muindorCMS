<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/settings', 'Admin\\AppSettingsController@getSetting');
Route::post('/admin/settings', 'Admin\\AppSettingsController@setSetting');
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');
Route::post('/user/verify', 'AuthController@verify');
Route::post('/user/profile', 'AuthController@updateProfile');


Route::post('/timeboard/search', 'Timeboard\MainController@searchTeacher');
Route::post('/timeboard/', 'Timeboard\MainController@getPairsByTeacherId');

Route::get('/ofp', 'Ofp\MainController@search');
