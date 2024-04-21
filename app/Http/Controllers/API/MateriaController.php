<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materia;

class MateriaController extends Controller
{

    
    //
    public function store(Request $request)
    {
        $materia = new Materia();
        $materia->codigo = $request->codigo;
        $materia->materia = $request->materia;
        $materia->grupo = $request->grupo;
        $materia->departamento = $request->departamento;
        $materia->save();
    }

    public function index()
    {
        $materias = Materia::all();
        return $materias;
    }


    public function get(){
        try{
            $data = Materia::get();
            return response()->json($data, 200);
        } catch (\Throwable $th){
            return response()->json(['error' => $th -> getMessage()],500);
        }
    }

    public function create(Request $request){
        try{
            $data['codigo']=$request['codigo'];
            $data['materia']=$request['materia'];
            $data['grupo']=$request['grupo'];
            $data['departamento']=$request['departamento'];
            $res = Materia::create($data);
            return response()->json($res, 200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th -> getMessage()],500);
        }
    }

    public function getById($id){
        try{
            $data = Materia::find($id);
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th -> getMessage()],500);
        }
    }

    public function update(Request $request, $id){
        try{
            $data['codigo']=$request['codigo'];
            $data['materia']=$request['materia'];
            $data['grupo']=$request['grupo'];
            $data['departamento']=$request['departamento'];
            Materia::find($id)->update($data);
            $res = Materia::find($id);
            return response()->json($data,200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th -> getMessage()],500);
        }
    }

    public function delete($id){
        try{
           
            $res = Materia::find($id)->delete();
            return response()->json(["deleted"=> $res],200);
        }catch(\Throwable $th){
            return response()->json(['error' => $th -> getMessage()],500);
        }

    }
}
