<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use APP\Http\Controllers\API\MateriaController;

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

Route::prefix('v1/materias')->group(function () {
    Route::get('/',[ MateriaController::class, 'get']);
    Route::post('/',[ MateriaController::class, 'store']);
    Route::get('/{id}',[ MateriaController::class, 'getById']);
    Route::put('/{id}',[ MateriaController::class, 'update']);
    Route::delete('/{id}',[ MateriaController::class, 'delete']);
});

Route::get('/materias', 'App\Http\Controllers\API\MateriaController@index');
Route::post('/materias', 'App\Http\Controllers\API\MateriaController@store');
Route::put('/materias', 'App\Http\Controllers\API\MateriaController@update');
Route::get('/materias/{id}', 'App\Http\Controllers\API\MateriaController@getById');

Route::get('/docentes', 'App\Http\Controllers\DocenteController@index');
Route::post('/docentes', 'App\Http\Controllers\DocenteController@store');
Route::put('/docentes', 'App\Http\Controllers\DocenteController@update');
Route::delete('/docentes/{id}', 'App\Http\Controllers\DocenteController@destroy');
