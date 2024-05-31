<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inhabilitado;
use Illuminate\Database\QueryException;

class AulaController extends Controller
{
    public function registrarAula(Request $request)
    {
        try {
            $aula = Aula::create([
                'unidad_id' => $request->unidad_id,
                'nombreAulas' => $request->nombreAulas,
                'capacidadAulas' => $request->capacidadAulas,
            ]);

            Inhabilitado::where('aula_id', $aula->id)->delete();

            return response()->json($aula, 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Error de consulta en la base de datos'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error inesperado'], 500);
        }
    }

    public function mostrarAula()
    {
        try {
            $aulas = Aula::all();
            return response()->json($aulas, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error al obtener las aulas'], 500);
        }
    }

    public function mostrarAulaPorUnidad($unidadId)
    {
        try {
            $aulas = Aula::where('unidad_id', $unidadId)->get();
            return response()->json($aulas, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error al obtener las aulas'], 500);
        }
    }
        public function postAula(Request $request){
            try {
        // Validar los datos de la solicitud
            $request->validate([
            'unidad_id' => 'required|exists:unidades,id',
            'nombreAulas' => 'required|string',
            'capacidadAulas' => 'required|string',
            ]);

        // Crear el nuevo aula
        $aula = Aula::create([
            'unidad_id' => $request->unidad_id,
            'nombreAulas' => $request->nombreAulas,
            'capacidadAulas' => $request->capacidadAulas,
        ]);

        return response()->json($aula, 201);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['error' => $e->errors()], 400);
    } catch (\Illuminate\Database\QueryException $e) {
        return response()->json(['error' => 'Error de consulta en la base de datos'], 500);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ocurrió un error inesperado'], 500);
    }
}
    public function updateAula(Request $request, $id){
        try {
        $aula = Aula::findOrFail($id);
        $request->validate([
            'nombreAulas' => 'required|string',
            'capacidadAulas' => 'required|string',
        ]);
        $aula->update([
            'nombreAulas' => $request->nombreAulas,
            'capacidadAulas' => $request->capacidadAulas,
        ]);
            return response()->json($aula, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el aula: ' . $e->getMessage()], 500);
        }
    }

    public function deshabilitarAula($id)
{
    try {
        $aula = Aula::findOrFail($id);

        if ($aula->inhabilitados()->exists()) {
            return response()->json(['error' => 'El aula ya está inhabilitada'], 400);
        }

        Inhabilitado::create([
            'aula_id' => $aula->id,
            
            'fecha' => now(),
        ]);
        return response()->json(['message' => 'Aula deshabilitada correctamente'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al deshabilitar el aula: ' . $e->getMessage()], 500);
    }
}
public function habilitar(Request $request, $id)
{
    $aula = Aula::find($id);
    if (!$aula) {
        return response()->json(['message' => 'Aula no encontrada'], 404);
    }

    $inhabilitado = Inhabilitado::where('aula_id', $aula->id)->first();

    if (!$inhabilitado) {
        Inhabilitado::create(['aula_id' => $aula->id, 'fecha' => now()]);
    } else {
        $inhabilitado->delete();
    }

    return response()->json(['message' => 'Estado del aula actualizado correctamente']);
}

    public function show($id)
    {
        try {
            $aula = Aula::find($id);
            return response()->json([
                'success' => true,
                'data' => $aula
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener el aula: ' . $e->getMessage()
            ], 500);
        }
    }
}