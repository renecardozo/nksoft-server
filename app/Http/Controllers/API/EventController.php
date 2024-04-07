<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;


class EventController extends Controller
{
  public function index(){
   $data=Event::all();
   return $data;
  }
  public function get()
{
    try {
        // Obtener todos los eventos ordenados por el más reciente
        $data = Event::get();
        return response()->json($data, 200);
    } catch (\Throwable $th) {
        return response()->json(['error' =>  $th->getMessage()], 500);
    }
}


   //guardar evennto y vlidacion
   public function create(Request $request){
       try{
         $data['fecha']= $request ['fecha'];
         $data['descripcion']= $request ['descripcion'];
         $data['codigo']= $request ['codigo'];
            $res = Event::create($data);
       return response()->json($res, 200);
   } catch(\Throwable $th){
       return response()->json(['error'=> $th->getMessage()],500);
   }
 
   }

   public function getById($id){
     try{
       $data=Event::find($id);
       return response()->json($data, 200);
     }catch(\Throwable $th){
       return response()->json(['error'=> $th->getMessage()],500);
   }
     }

   public function update(Request $request,$id){
     try{
       $data['fecha']= $request ['fecha'];
       $data['descripcion']= $request ['descripcion'];
       $data['codigo']= $request ['codigo'];
         
       $res= Event::find($id);
           return response()->json($res, 200);
       } catch(\Throwable $th){
         return response()->json(['error'=> $th->getMessage()],500);
     }
   }
 

   public function delete($id){
     try{
       
       $res=event::find($id)->delete();
       
       return response()->json(["deleted"=> $res],00);
     } catch(\Throwable $th){
       return response()->json(['error'=> $th->getMessage()],500);
   }

   }  
}
