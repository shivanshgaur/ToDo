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

Route::resource('checklists', 'ListController')->only([
    'index', 'show', 'store', 'destroy', 'update',
])->middleware('auth.basic');

Route::resource('tasks', 'TaskController')->only([
    'show', 'store', 'destroy', 'update',
])->middleware('auth.basic');

Route::resource('users', 'UserController');
