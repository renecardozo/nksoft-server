<?php

use App\Http\Controllers\API\EventController;
use App\Http\Controllers\AulaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use APP\Http\Controllers\API\MateriaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PeriodoController;


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


//Materia
Route::get('/materias', 'App\Http\Controllers\API\MateriaController@index');
Route::post('/materias', 'App\Http\Controllers\API\MateriaController@store');
Route::post('/materias2', 'App\Http\Controllers\API\MateriaController@guardar');
Route::post('/materiasDuplicado', 'App\Http\Controllers\API\MateriaController@verificar'); 
Route::put('/materias', 'App\Http\Controllers\API\MateriaController@update');
Route::get('/materias/{id}', 'App\Http\Controllers\API\MateriaController@getById');


Route::get('/docentes', 'App\Http\Controllers\DocenteController@index');
Route::post('/docentes', 'App\Http\Controllers\DocenteController@store');
Route::put('/docentes', 'App\Http\Controllers\DocenteController@update');
Route::delete('/docentes/{id}', 'App\Http\Controllers\DocenteController@destroy');

Route::prefix('v1/event')->group(function(){
   Route::get('/',[ EventController::class, 'get'] );
   Route::post('/',[ EventController::class, 'create'] );
   Route::get('/{id}',[ EventController::class, 'getById'] );
   Route::put('/{id}',[ EventController::class, 'update'] );
   Route::delete('/{id}',[ EventController::class, 'delete'] );
});

Route::post('/login', [ AuthController::class, 'login']);
Route::post('/admin', [ AuthController::class, 'admin']);
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
Route::get('/users/docentes', 'App\Http\Controllers\UserController@showDocentes'); // Devuelve usuarios con rol de docente
Route::get('/users/{id}', 'App\Http\Controllers\UserController@getById');
Route::post('/users', 'App\Http\Controllers\UserController@store');
Route::delete('/users/{id}', 'App\Http\Controllers\UserController@destroy');
Route::put('/users/{id}', 'App\Http\Controllers\UserController@update');

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

//solicitudes

Route::get('solicitud', 'App\Http\Controllers\SolicitudController@index');
Route::put('solicitud/{id}', 'App\Http\Controllers\SolicitudController@stateRequest');
Route::get('solicitud/{id}', 'App\Http\Controllers\SolicitudController@show');
Route::post('filtro', 'App\Http\Controllers\SolicitudController@filter');
Route::post('recomendacion', 'App\Http\Controllers\SolicitudController@recomendacion');



Route::get('/periodos', 'App\Http\Controllers\PeriodoController@index');
Route::put('/aulas/{id}/habilitar', 'App\Http\Controllers\AulaController@habilitar');
Route::get('/inhabilitados/aulas', 'App\Http\Controllers\InhabilitadoController@getAulasInhabilitadas');

//habilitacion
Route::post('/aulas/{id}/deshabilitar', 'App\Http\Controllers\AulaController@deshabilitarAula');

//eliminacion de un ; innecesario
Route::middleware(['role:SuperAdmin'])->group(function(){
   Route::post('feriados', 'App\Http\Controllers\FeriadoController@createFeriados');
   Route::put('calendario/{id}', 'App\Http\Controllers\CalendarioController@editCalendario');
   Route::delete('usuarios/{id}', 'App\Http\Controllers\UserController@deleteUsuarios');
   Route::post('materias', 'App\Http\Controllers\MateriaController@createMaterias'); 
   Route::put('materias/{id}', 'App\Http\Controllers\MateriaController@editMaterias');
   Route::post('roles', 'App\Http\Controllers\RolController@createRoles');
   Route::delete('calendario/{id}', 'App\Http\Controllers\CalendarioController@deleteCalendario');
   Route::put('feriados/{id}', 'App\Http\Controllers\FeriadoController@editFeriados');
   Route::delete('feriados/{id}', 'App\Http\Controllers\FeriadoController@deleteFeriados');
   Route::post('usuarios', 'App\Http\Controllers\UserController@createUsuarios');
   Route::put('roles/{id}', 'App\Http\Controllers\RolController@editRoles');
   Route::delete('materias/{id}', 'App\Http\Controllers\MateriaController@deleteMaterias');
   Route::delete('roles/{id}', 'App\Http\Controllers\RolController@deleteRoles');
   Route::put('usuarios/{id}', 'App\Http\Controllers\UserController@editUsuarios');
   Route::post('calendario', 'App\Http\Controllers\CalendarioController@createCalendario');
});

//Solicitud Reserva Aula
Route::get('/solicitud_reserva_aula',  'App\Http\Controllers\SolicitudReservaAulaController@index');
Route::get('/solicitud_reserva_aula/{id}', 'App\Http\Controllers\SolicitudReservaAulaController@getById');
Route::post('/solicitud_reserva_aula', 'App\Http\Controllers\SolicitudReservaAulaController@store');
Route::delete('/solicitud_reserva_aula/{id}', 'App\Http\Controllers\SolicitudReservaAulaController@destroy');
Route::put('/solicitud_reserva_aula/{id}', 'App\Http\Controllers\SolicitudReservaAulaController@update');

#docente-ini
Route::middleware(['role:docente'])->group(function(){
   Route::post('feriados', 'App\Http\Controllers\FeriadoController@createFeriados');
   Route::put('feriados/{id}', 'App\Http\Controllers\FeriadoController@editFeriados');
   Route::delete('feriados/{id}', 'App\Http\Controllers\FeriadoController@deleteFeriados');
});
#docente-fin

//Docente Materia
Route::get('/docente_materia',  'App\Http\Controllers\DocenteMateriaController@index');
Route::get('/docente_materia/{id}', 'App\Http\Controllers\DocenteMateriaController@getById');
Route::post('/docente_materia', 'App\Http\Controllers\DocenteMateriaController@store');
Route::delete('/docente_materia/{id}', 'App\Http\Controllers\DocenteMateriaController@destroy');
Route::put('/docente_materia/{id}', 'App\Http\Controllers\DocenteMateriaController@update');

#Auxiliar-ini
Route::middleware(['role:Auxiliar'])->group(function(){
   Route::post('feriados', 'App\Http\Controllers\FeriadoController@createFeriados');
   Route::put('feriados/{id}', 'App\Http\Controllers\FeriadoController@editFeriados');
});
#Auxiliar-fin

#Docente-ini
Route::middleware(['role:Docente'])->group(function(){
   Route::get('/reservass', 'App\Http\Controllers\SolicitudReservaAulaController@post');
   Route::get('materiass', 'App\Http\Controllers\MateriaController@index');
   Route::put('/reservass', 'App\Http\Controllers\SolicitudReservaAulaController@update');
});
#Docente-fin
