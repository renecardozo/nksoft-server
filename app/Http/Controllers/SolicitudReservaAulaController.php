<?php

namespace App\Http\Controllers;

use App\Http\Resources\SolicitudReservaAulaResource;
use App\Models\SolicitudReservaAula;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SolicitudReservaAulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->has('id_user')) {
            $query = $request->query('id_user');
            return response()->json(SolicitudReservaAulaResource::collection(SolicitudReservaAula::where('id_user', $query)->get()));
        }
        var_dump($request->all());
        return response()->json(SolicitudReservaAulaResource::collection(SolicitudReservaAula::all()));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // "id_solicitud" => "optional",
            "fecha_solicitud" => "required",
            "motivo_reserva" => "required",
            "id_materia" => "required|exists:materia,id",
            "id_periodo" => "required|exists:periodos,id",
            "id_aula" => "required|exists:aulas,id",
            "id_user" => "required|exists:users,id",
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'Error al crear solicitud', 'error' => $validator->errors()], 400);
        } else {
            if (!@$request->estado) {
                $request->request->add(['estado' => 'pendiente']);;
            }
            if (@$request->id_periodo) {
                $request->request->add(['id_horario' => $request->id_periodo]);
            }
            if (!@SolicitudReservaAula::find($request->id_solicitud)) {
                $data_all = $request->all();
                SolicitudReservaAula::create($data_all);
                return response()->json(['success' => true, 'message' => 'Solicitud creada exitosamente'], 201);
            } else {
                $data_update = $request->except('id_solicitud');
                $solicitud = SolicitudReservaAula::find($request->id_solicitud);
                $solicitud->update($data_update);
                return response()->json(['success' => true, 'message' => 'Solicitud actualizada exitosamente'], 201);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SolicitudReservaAula  $solicitudReservaAula
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        if (@SolicitudReservaAula::find($id) == null) {
            return response()->json(['error' => true, 'message' => 'Solicitud not found'], 404);
        }
        return response()->json(new SolicitudReservaAulaResource(SolicitudReservaAula::find($id)));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "fecha_solicitud" => "required",
            "motivo_reserva" => "required",
            "id_materia" => "required|exists:materia,id",
            "id_periodo" => "required|exists:periodos,id",
            "id_aula" => "required|exists:aulas,id",
            "id_user" => "required|exists:users,id",
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'Error al actualizar solicitud', 'error' => $validator->errors()], 400);
        } else {
            if (!@$request->estado) {
                $request->request->add(['estado' => 'pendiente']);;
            }
            if (@$request->id_periodo) {
                $request->request->add(['id_horario' => $request->id_periodo]);
            }
            $data_update = $request->all();
            $solicitud = SolicitudReservaAula::find($id);
            $solicitud->update($data_update);
            return response()->json(['success' => true, 'message' => 'Solicitud actualizada exitosamente'], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (@SolicitudReservaAula::find($id) == null) {
            return response()->json(['error' => true, 'message' => 'Solicitud not found'], 404);
        }
        SolicitudReservaAula::find($id)->delete();
        return response()->json(['success' => true, 'message' => 'Solicitud de reserva de aula eliminado exitosamente'], 201);
    }
}
