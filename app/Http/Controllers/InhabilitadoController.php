<?php

namespace App\Http\Controllers;

use App\Models\Inhabilitado;
use Illuminate\Http\Request;

class InhabilitadoController extends Controller
{
    public function index()
    {
        $inhabilitados = Inhabilitado::all();
        return response()->json($inhabilitados);
    }

    public function store(Request $request)
{
    $request->validate([
        'aula_id' => 'required|integer',
        // No es necesario validar la fecha, ya que se proporcionará un valor predeterminado si no se incluye en la solicitud
    ]);

    $fecha = $request->input('fecha', now()); // Valor predeterminado: fecha y hora actual

    // Crear un nuevo registro de inhabilitado con el valor de fecha adecuado
    $inhabilitado = Inhabilitado::create([
        'aula_id' => $request->input('aula_id'),
        'fecha' => $fecha,
    ]);

    return response()->json($inhabilitado, 201);
}
public function getAulasInhabilitadas()
{
    // Obtener las aulas inhabilitadas
    $aulasInhabilitadas = Inhabilitado::pluck('aula_id')->toArray();

    return response()->json($aulasInhabilitadas);
}

}
