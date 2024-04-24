<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnidadController extends Controller
{
    public function registrarUnidad(Request $request)
{
    try {
        $data['nombreUnidades'] = $request['nombreUnidades'];
        $data['horaAperturaUnidades'] = $request['horaAperturaUnidades'];
        $data['horaCierreUnidades'] = $request['horaCierreUnidades'];
        $data['departamento_id'] = $request['departamento_id'];
        $res = Unidad::create($data);
        return response()->json(['id' => $res->id], 200);
    } catch(\Throwable $th) {
        return response()->json(['error' => $th->getMessage()], 500);
    }
}

    public function mostrarUnidad(){
        try{
            $data = Unidad::with('departamento')->get();
            return response()->json($data, 200);
        } catch (\Throwable $th){
            return response()->json(['error' => $th -> getMessage()],500);
        }
    }

    public function actualizarUnidad(Request $request, $id)
{
    try {
        $unidad = Unidad::findOrFail($id);
        $request->validate([
            'nombreUnidades' => 'required|string',
            'horaAperturaUnidades' => 'required|string',
            'horaCierreUnidades' => 'required|string',
        ]);

        $unidad->update([
            'nombreUnidades' => $request->nombreUnidades,
            'horaAperturaUnidades' => $request->horaAperturaUnidades,
            'horaCierreUnidades' => $request->horaCierreUnidades,
        ]);

        return response()->json($unidad, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al actualizar la unidad: ' . $e->getMessage()], 500);
    }
}

}