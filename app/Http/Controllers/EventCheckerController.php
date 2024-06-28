<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudReservaAula;
use App\Models\Inhabilitado;
use App\Models\Aula;
use App\Models\SolicitudPeriodo;
use App\Models\Periodo;
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
        $periodos = $request['periodos'];

        // Validate the required parameters
        $validator = Validator::make($request->all(), [
            'aula' => 'string',
            'fecha' => 'date',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'Error al crear solicitud', 'error' => $validator->errors()], 400);
        } 
        if (!empty($aulaId)) {
            // Query the RequestRoom model to find any matching records
            $bookings = SolicitudReservaAula::where('id_aula', $aulaId)
                ->where('fecha_hora_reserva', $fecha)
                ->whereIn('estado', ['aceptada', 'pendiente'])
                ->get();
            $bookingIds = collect();
            foreach ($bookings as $booking) {
                $bookingIds->push($booking->id);
            }
            $isInPeriods = SolicitudPeriodo::whereIn('solicitud_reserva_aula_id', $bookingIds)->whereIn('periodo_id', $periodos)->get();
            $isAvailable = Inhabilitado::where('aula_id', $aulaId)->get();
            if ($bookings->isEmpty() && $isAvailable->isEmpty() && $isInPeriods->isEmpty()) {
                
                $userRoomWanted = Aula::where('id', $aulaId)->get();
                return response()->json([
                    // 'allSuggestion' => $allSuggestionByCapacity,
                    'rooms' => $userRoomWanted
                ], 200);
            } else {
                return response()->json(['data' => [], 'message' => 'This roon is not available']);
            }
        } else if (!empty($capacidad)) {
            $allSuggestionByCapacity = Aula::where('capacidadAulas', '>=', $capacidad)->get();
            return response()->json([
                'rooms' => $allSuggestionByCapacity
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Seems that your request can not be procesed becuase is missing a valid params like : aula and date'
            ], 400);
        }
    }
}
