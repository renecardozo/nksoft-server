<?php

namespace App\Http\Controllers;

use App\Models\SolicitudReservaAula;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index()
    {
        try {
            $requests = SolicitudReservaAula::orderBy('created_at', 'asc')
                        ->with('materia','periodos')
                        ->get();
            return response()->json([
                'success' => true,
                'data' => $requests
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener las solicitudes: ' . $e->getMessage()
            ], 500);
        }
    }
    public function filter(Request $body)
    {
        try {
            if ($body->value === 'llegada') {
                $requests = SolicitudReservaAula::orderBy('created_at', 'desc')->get();
                return response()->json([
                    'success' => true,
                    'data' => $requests,
                ]);
            }
            if ($body->value  == 'urgencia') {
                $currentDate = Carbon::now()->toDateString();

                $requests = SolicitudReservaAula::whereDate('fecha_hora_reserva', $currentDate)
                    ->orderBy('fecha_hora_reserva', 'asc')
                    ->get();
                return response()->json([
                    'success' => true,
                    'data' => $requests,
                ]);
            }
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener las solicitudes: ' . $e->getMessage()
            ], 500);
        }
    }

    public function stateRequest(Request $body, $id)
    {

        try {
            $solicitud = SolicitudReservaAula::find($id);
            $solicitud->estado = $body->value;
            $solicitud->update();
            return response()->json([
                'success' => true,
                'data' => $solicitud
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al actualizar la solicitude: ' . $e->getMessage()
            ], 500);
        }
    }
    public function show($id)
    {
        try {
            $solicitud = SolicitudReservaAula::find($id);
            return response()->json([
                'success' => true,
                'data' => $solicitud
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener las solicitudes: ' . $e->getMessage()
            ], 500);
        }
    }


}
