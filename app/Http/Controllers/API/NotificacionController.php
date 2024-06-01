<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class NotificacionController extends Controller
{
    public function guardar(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'id_solicitud' => 'required|integer',
            'respuesta' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Crear una nueva notificación
            $notificacion = new Notificacion();
            $notificacion->id_solicitud = $request->id_solicitud;
            $notificacion->respuesta = $request->respuesta;
            $notificacion->save();

            return response()->json(['message' => 'Notificación guardada con éxito'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar la notificación', 'details' => $e->getMessage()], 500);
        }
    }

    public function leer()
    {
        try {
            $notificaciones = Notificacion::all();
            return response()->json($notificaciones, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al leer las notificaciones', 'details' => $e->getMessage()], 500);
        }
    }

    public function mostrar($id)
    {
        try {
            $notificacion = Notificacion::find($id);
    
            if (!$notificacion) {
                return response()->json([
                    'success' => false,
                    'error' => 'Notificacion no encontrada'
                ], 404);
            }
    
            return response()->json([
                'success' => true,
                'data' => $notificacion
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener las solicitudes: ' . $e->getMessage()
            ], 500);
        }
    }
}