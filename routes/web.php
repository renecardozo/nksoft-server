<?php

use App\Http\Controllers\CalendarioController;
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

Route::get('/', function () {
    return view('welcome');
});

//::resource('calendario', CalendarioController::class);
Route::get('Calendar/event','ControllerCalendar@index');
Route::get('Evento/form','ControllerEvent@form');