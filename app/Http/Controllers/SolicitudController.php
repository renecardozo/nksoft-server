<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index()
    {
        try {
            $requests = Solicitud::orderBy('created_at', 'asc')->get();
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
                $requests = Solicitud::orderBy('created_at', 'desc')->get();
                return response()->json([
                    'success' => true,
                    'data' => $requests,
                ]);
            }
            if ($body->value  == 'urgencia') {
                $currentDate = Carbon::now()->toDateString();

                // Obtener todas las solicitudes de la fecha actual
                $requests = Solicitud::whereDate('created_at', $currentDate)
                    ->orderBy('created_at', 'asc')
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
            $solicitud = Solicitud::find($id);
            $solicitud->state = $body->value;
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
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        try {
            $solicitud = Solicitud::find($id);
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

    public function edit(Solicitud $solicitud)
    {
        //
    }

    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    public function destroy(Solicitud $solicitud)
    {
        //
    }
}
