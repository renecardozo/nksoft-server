<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DocenteMateriaResource;
use App\Models\DocenteMateria;
use Illuminate\Support\Facades\Validator;
class DocenteMateriaController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(DocenteMateriaResource::collection(DocenteMateria::all()));
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
            "docente_id" => "required|exists:users,id",
            "materia_id" => "required|exists:materia,id",
            "grupo" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'Error al crear solicitud', 'error' => $validator->errors()], 400);
        } else {
              $data_all = $request->all();
              DocenteMateria::create($data_all);
              return response()->json(['success' => true, 'message' => 'Solicitud creada exitosamente'], 201);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocenteMateria  $DocenteMateria
     * @return \Illuminate\Http\Response
     */
    public function getById($usuarioId)
{
    $docenteMaterias = DocenteMateria::where('docente_id', $usuarioId)->get();

    if ($docenteMaterias->isEmpty()) {
        return response()->json(['error' => true, 'message' => 'No se encontraron materias para el usuario'], 404);
    }

    return response()->json(DocenteMateriaResource::collection($docenteMaterias));
}




    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "docente_id" => "required|exists:users,id",
            "materia_id" => "required|exists:materia,id",
            "grupo" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'Error al crear solicitud', 'errors' => $validator->errors()], 400);
        } else {
            $data_update = $request->all();
            $solicitud = DocenteMateria::find($id);
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
        if (@DocenteMateria::find($id) == null) {
            return response()->json(['error' => true, 'message' => 'Solicitud not found'], 404);
        }
        DocenteMateria::find($id)->delete();
        return response()->json(['success' => true, 'message' => 'Solicitud de reserva de aula eliminado exitosamente'], 201);
    }
}
