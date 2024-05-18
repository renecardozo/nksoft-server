<?php

namespace App\Http\Controllers;

use App\Models\SolicitudReservaAula;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudController extends Controller
{
    public function index()
    {
        try {
            $requests = SolicitudReservaAula::orderBy('created_at', 'asc')
                ->with('materia', 'periodos', 'users')
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
                $requests = SolicitudReservaAula::orderBy('created_at', 'desc')
                    ->with('materia', 'periodos', 'users')
                    ->get();
                return response()->json([
                    'success' => true,
                    'data' => $requests,
                ]);
            }
            if ($body->value  == 'urgencia') {

                $currentDate = Carbon::now('America/La_Paz')->toDateString();
                $currentDateTime = $currentDate . ' 00:00:00.000';

                $requests = SolicitudReservaAula::whereDate('fecha_hora_reserva', $currentDateTime)
                    ->orderBy('fecha_hora_reserva', 'asc')
                    ->with('materia', 'periodos', 'users')
                    ->get();

                // Verificar si hay registros devueltos
                if ($requests->isEmpty()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'No requests found for the current date',
                        'fec' => $currentDateTime

                    ]);
                }
                return response()->json([
                    'success' => true,
                    'data' => $requests,
                ]);
            }
            if ($body->value  == 'motivo') {
                $requests = SolicitudReservaAula::with('materia', 'periodos', 'users')->get();

                if ($requests->isEmpty()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'No requests found',
                    ]);
                }

                $sortedRequests = $requests->sortBy(function ($request) {
                    $order = ['Conferencia', 'Examen', 'Reunion', 'Clases'];
                    return array_search($request->motivo_reserva, $order);
                })->values();

                $sortedRequestsArray = $sortedRequests->toArray();

                return response()->json([
                    'success' => true,
                    'data' => $sortedRequestsArray,
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
