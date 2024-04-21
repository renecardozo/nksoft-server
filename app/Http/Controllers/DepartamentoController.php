<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function registrarDepartamento(Request $request)
    {
        $request->validate([
            'nombreDepartamentos' => 'required|string|max:255',
        ]);

        $departamento = new Departamento();
        $departamento->nombreDepartamentos = $request->nombre;
        $departamento->save();

        return response()->json(['message' => 'Departamento registrado correctamente'], 201);
    }
}