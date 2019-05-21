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

Route::get('/', function (Request $request) {
    return ['message' => 'Hi from PMS API!'];
});

Route::resource('user', 'UserController', ['except' => ['create', 'edit']]);

Route::resource('role', 'RoleController', ['except' => ['create', 'edit']]);

Route::resource('company', 'CompanyController', ['except' => ['create', 'edit']]);

Route::resource('property', 'PropertyController', ['except' => ['create', 'edit']]);

Route::resource('resident', 'ResidentController', ['except' => ['create', 'edit']]);

Route::resource('tower', 'TowerController', ['except' => ['create', 'edit']]);

Route::resource('unit', 'UnitController', ['except' => ['create', 'edit']]);

Route::resource('module', 'ModuleController', ['except' => ['create', 'edit']]);

Route::resource('module-option', 'ModuleOptionController', ['except' => ['create', 'edit']]);
