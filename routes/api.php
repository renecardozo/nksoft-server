<?php

use App\Http\Controllers\API\EventController;
use App\Http\Controllers\AulaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use APP\Http\Controllers\API\MateriaController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\AuthController;


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

Route::prefix('v1/event')->group(function(){
   Route::get('/',[ EventController::class, 'get'] );
   Route::post('/',[ EventController::class, 'create'] );
   Route::get('/{id}',[ EventController::class, 'getById'] );
   Route::put('/{id}',[ EventController::class, 'update'] );
   Route::delete('/{id}',[ EventController::class, 'delete'] );
});

Route::post('/login', [ AuthController::class, 'login']);
//Roles y permisos
Route::get('/roles', 'App\Http\Controllers\RoleController@index');
Route::get('/permissions', 'App\Http\Controllers\RoleController@getPermissions');
Route::post('/create', 'App\Http\Controllers\RoleController@createRole');
Route::delete('/update/{id}', 'App\Http\Controllers\RoleController@updateStateRole');
Route::get('/role/{id}', 'App\Http\Controllers\RoleController@getRole');
Route::post('/editar/{id}', 'App\Http\Controllers\RoleController@editRole');
Route::get('/role-permissions', 'App\Http\Controllers\RoleController@getRoles');

//Usuarios

Route::get('/users',  'App\Http\Controllers\UserController@index');
Route::get('/users/{id}', 'App\Http\Controllers\UserController@getById');


//Unidades
Route::post('/departamentos', 'App\Http\Controllers\DepartamentoController@registrarDepartamento');
Route::get('/departamentos', 'App\Http\Controllers\DepartamentoController@mostrarDepartamento');
Route::post('/unidades', 'App\Http\Controllers\UnidadController@registrarUnidad');
Route::get('/unidades', 'App\Http\Controllers\UnidadController@mostrarUnidad');
Route::get('/unidades/obtenerNombre', 'App\Http\Controllers\UnidadController@obtenerNombre');
Route::put('/unidades/{id}', 'App\Http\Controllers\UnidadController@actualizarUnidad');


///Registro de aula
Route::post('/aulas/registrar', 'App\Http\Controllers\AulaController@registrarAula');
Route::get('/aulas/mostrar','App\Http\Controllers\AulaController@mostrarAula');
Route::get('/aulas/mostrarId/{unidadId}', 'App\Http\Controllers\AulaController@mostrarAulaPorUnidad');
Route::post('/aulas/post', 'App\Http\Controllers\AulaController@postAula');
Route::put('/aulas/{id}', 'App\Http\Controllers\AulaController@updateAula');

Route::get('periodos/horaApertura', 'App\Http\Controllers\PeriodoController@horaApertura');
Route::get('periodos/horaCierre', 'App\Http\Controllers\PeriodoController@horaCierre');



#Docente-ini
Route::middleware(['role:Docente'])->group(function(){
   Route::put('/aulas/{id}', 'App\Http\Controllers\AulaController@registrarAula');
   Route::post('/departamentos', 'App\Http\Controllers\DepartamentoController@registrarDepartamento');
});
#Docente-fin
#Admin-ini
Route::middleware(['role:Admin'])->group(function(){
   Route::put('/aulas/{id}', 'App\Http\Controllers\AulaController@registrarAula');
   Route::post('/departamentos', 'App\Http\Controllers\DepartamentoController@registrarDepartamento');
   Route::delete('/update/{id}', 'App\Http\Controllers\RolController@updateStateRole');
   Route::put('usuarios/{id}', 'App\Http\Controllers\UserController@editUsuarios');
   Route::post('calendario', 'App\Http\Controllers\CalendarioController@createCalendario');
   Route::delete('feriados/{id}', 'App\Http\Controllers\FeriadoController@deleteFeriados');
   Route::post('usuarios', 'App\Http\Controllers\UserController@createUsuarios');
   Route::post('/editar/{id}', 'App\Http\Controllers\RolController@editRoles');
   Route::put('materias', 'App\Http\Controllers\MateriaController@update');
   Route::post('/aulas/registrar', 'App\Http\Controllers\AulaController@registrarAula');
   Route::post('/unidades/{id}', 'App\Http\Controllers\UnidadController@actualizarUnidad');
   Route::post('materias', 'App\Http\Controllers\MateriaController@store');
   Route::post('/create', 'App\Http\Controllers\RolController@createRoles');
   Route::delete('calendario/{id}', 'App\Http\Controllers\CalendarioController@deleteCalendario');
   Route::put('feriados/{id}', 'App\Http\Controllers\FeriadoController@editFeriados');
   Route::post('feriados', 'App\Http\Controllers\FeriadoController@createFeriados');
   Route::put('calendario/{id}', 'App\Http\Controllers\CalendarioController@editCalendario');
   Route::delete('usuarios/{id}', 'App\Http\Controllers\UserController@deleteUsuarios');
   Route::get('materias', 'App\Http\Controllers\MateriaController@index');
   Route::post('/unidades', 'App\Http\Controllers\UnidadController@registrarUnidad');
});
#Admin-fin
