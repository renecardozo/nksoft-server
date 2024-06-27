<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Mail\AdminEmail;
use App\Mail\DescriptionMail;
use App\Models\Aula;
use App\Models\Materia;
use App\Models\SolicitudReservaAula;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

            $solicitud = SolicitudReservaAula::find($request->id_solicitud);
            $user = User::find($solicitud->id_user);
            $aula = Aula::find($solicitud->id_aula);
            $materia = Materia::find($solicitud->id_materia);
            Log::info($solicitud); //var_dump($solicitud);
            $title = "Mensaje de administración";
            $razon_solicitud = $solicitud->motivo_reserva;
            $ambiente = $aula->nombreAulas;
            $materia = $materia->materia;
            $fecha = Carbon::parse($solicitud->fecha_hora_reserva)->format('d/m/Y');
            $estado_de_solicitud = $solicitud->estado;
            $content = $request->respuesta;
            Mail::to($user->email)->send(new AdminEmail($title, $razon_solicitud, $ambiente, $materia, $fecha, $estado_de_solicitud, $content));
            return response()->json(['message' => 'Notificación guardada con éxito'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar la notificación', 'details' => $e->getMessage()], 500);
        }
    }

    public function leer()
    {
        try {
            $notificaciones = Notificacion::with(['solicitud', 'solicitud.aulas'])->get();
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
    public function enviarMasivo(Request $request)
    {
        $emails = User::whereIn('id', $request->users)->pluck('email')->toArray();
        $details = [
            'mensaje' => $request->mensaje ?? '',
            'titulo' => $request->titulo ?? '',
        ];
        $envios_fallidos = 0;
        foreach ($emails as $recipient) {
            try {
                Mail::to($recipient)->send(new DescriptionMail($details));
            } catch (\Exception $e) {
                $envios_fallidos = $envios_fallidos + 1;
            }
        }
        return response()->json('envio completado con fallas:' . $envios_fallidos);
    }
}
