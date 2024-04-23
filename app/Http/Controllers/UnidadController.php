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
}