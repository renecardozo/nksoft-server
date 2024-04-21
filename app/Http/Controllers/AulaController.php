<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function registrarAula(Request $request)
    {
        try {
            // Validar los datos de la solicitud
            $request->validate([
                'unidad_id' => 'required|exists:unidades,id',
                'nombreAulas' => 'required|string',
                'capacidadAulas' => 'required|integer',
            ]);

            // Crear el nuevo aula
            $aula = Aula::create([
                'unidad_id' => $request->unidad_id,
                'nombreAulas' => $request->nombreAulas,
                'capacidadAulas' => $request->capacidadAulas,
            ]);

            // Devolver la respuesta
            return response()->json($aula, 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Error de consulta en la base de datos'], 500);
        } catch (\Exception $e) {
            // Manejar otros errores no esperados
            return response()->json(['error' => 'Ocurrió un error inesperado'], 500);
        }
    }

    public function mostrarAula()
    {
        try {
            // Obtener todas las aulas
            $aulas = Aula::all();

            // Devolver la respuesta
            return response()->json($aulas, 200);
        } catch (\Exception $e) {
            // Manejar errores no esperados
            return response()->json(['error' => 'Ocurrió un error al obtener las aulas'], 500);
        }
    }
}
