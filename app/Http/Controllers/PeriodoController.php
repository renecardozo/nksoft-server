<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\SolicitudReservaAula;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index()
    {
        $periodos = Periodo::all();

        return response()->json($periodos);
    }
    public function horaApertura()
    {
        // Obtener las horas de apertura para los primeros 7 periodos
        $horaApertura = Periodo::orderBy('id')->limit(7)->pluck('horaInicio');

        return response()->json($horaApertura);
    }

    public function horaCierre()
    {
        // Obtener las horas de cierre para los primeros 10 periodos
        $horaCierre = Periodo::orderBy('id')->limit(10)->pluck('horaFin');

        return response()->json($horaCierre);
    }
    public function solicitudes()
    {
        return $this->belongsToMany(SolicitudReservaAula::class);
    }
}
