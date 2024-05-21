<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudReservaAula;
use App\Models\Inhabilitado;
use App\Models\Aula;
use App\Models\SolicitudPeriodo;
use App\Http\Resources\SolicitudReservaAulaResource;
use Illuminate\Support\Facades\Validator;

class EventCheckerController extends Controller
{

    /**
     * Check if the room is booked.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkMatches(Request $request)
    {
        // Retrieve query parameters
        $aula = $request['aula'];
        $aulaId = $request['aulaId'];
        $capacidad = $request['capacidad'];
        $fecha = $request['fecha'];
        $unidadId = $request['unidadId'];
        $periodos = $request['periodos'];

        // Validate the required parameters
        $validator = Validator::make($request->all(), [
            'unidadId' => 'required|string',
            'aulaId' => 'required|string',
            'aula' => 'required|string',
            'capacidad' => 'required|integer',
            'fecha' => 'required|date',
        ]);

        if (empty($periodos)) {
            return response()->json(['error' => 'No period IDs provided'], 400);
        }

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'Error al crear solicitud', 'error' => $validator->errors()], 400);
        } else {
            // Query the RequestRoom model to find any matching records
            $bookings = SolicitudReservaAula::where('id_aula', $aulaId)
                 ->where('fecha_hora_reserva', $fecha)
                ->whereIn('estado', ['aceptada', 'pendiente'])
                ->get();
            // echo $bookings;
            $isAvailable = Inhabilitado::where('aula_id', $aulaId)
                ->get();
            // Check if there are any bookings that match the criteria
            if ($bookings->isEmpty() && $isAvailable->isEmpty()) {
                $allSuggestion = Aula::where('unidad_id', $unidadId)
                    ->where('capacidadAulas', '>=', $capacidad)
                    ->get();
                $userRoomWanted = Aula::find($aulaId);
                return response()->json(['rooms' => $allSuggestion->push($userRoomWanted)], 200);
            } else {
                $exists = SolicitudPeriodo::where('solicitud_reserva_aula_id', $bookings[0]['id'])
                    ->whereIn('periodo_id', $periodos)
                    ->get();
                if ($exists->isEmpty()) {
                    $allSuggestion = Aula::where('unidad_id', $unidadId)
                        ->where('capacidadAulas', '>=', $capacidad)
                        ->get();
                    $userRoomWanted = Aula::find($aulaId);
                    return response()->json(['rooms' => $allSuggestion->push($userRoomWanted)], 200);
                } else {
                    $allSuggestionNotBooked = Aula::where('unidad_id', $unidadId)
                    ->where('capacidadAulas', '>=', $capacidad)
                        ->where('id', '!=', $aulaId)
                        ->get();
                    return response()->json(['message' => $allSuggestionNotBooked]);
                    
                }
            }
        }
    }

}
