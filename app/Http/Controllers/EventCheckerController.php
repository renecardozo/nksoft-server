<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudReservaAula;
use App\Models\Inhabilitado;

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
        $aula = $request->query('aula');
        $aulaId = $request->query('aulaId');
        $capacidad = $request->query('capacidad');
        $fecha = $request->query('fecha');

        // Validate the required parameters
        $request->validate([
            'aula' => 'required|string',
            'capacidad' => 'required|integer',
            'fecha' => 'required|date',
        ]);

        // Query the RequestRoom model to find any matching records
        $bookings = SolicitudReservaAula::where('aula', $aula)
            ->where('date', $date)
            ->whereIn('state', ['aceptada', 'pendiente'])
            ->get();

        $isAvailable = Inhabilitado::where('aula_id', $aulaId)
            ->get();
        
        // Check if there are any bookings that match the criteria
        if ($bookings->isEmpty() && $isAvailable->isEmpty()) {
            echo 'La aula esta libre';
            return response()->json(['message' => 'Room is available'], 200);
        } else {
            return response()->json(['message' => 'Room is already booked'], 200);
        }
    }

}
