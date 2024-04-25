<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartamentoController extends Controller
{
    public function registrarDepartamento(Request $request)
    {try{
        $data['nombreDepartamentos']=$request['nombreDepartamentos'];
        $res = Departamento::create($data);
        return response()->json($res, 200);
    }catch(\Throwable $th){
        return response()->json(['error' => $th -> getMessage()],500);
    } }

    public function mostrarDepartamento(){
    try{
        $data = Departamento::get();
        return response()->json($data, 200);
    } catch (\Throwable $th){
        return response()->json(['error' => $th -> getMessage()],500);
    }
    }
}