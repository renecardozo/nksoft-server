<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use Carbon\Carbon;

class BitacoraController extends Controller
{
   // Display a listing of the resource
   public function index()
   {
       $bitacoras = Bitacora::all();
       return response()->json($bitacoras);
   }

   // Store a newly created resource in storage
   public function store(Request $request)
   {
        $request->validate([
            'timestamp' => 'required|date',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|string|max:255',
            'id_resource' => 'required|integer',
            'name_resource' => 'required|string|max:255',
            'actions' => 'required|string|max:255',
        ]);

        // Convert timestamp to Carbon instance
        // $timestamp = Carbon::parse($request->input('timestamp'));

        // Create the bitacora record
        $bitacora = Bitacora::create([
            'timestamp' => $request->input('timestamp'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'id_resource' => $request->input('id_resource'),
            'name_resource' => $request->input('name_resource'),
            'actions' => $request->input('actions'),
        ]);

        return response()->json($bitacora, 201);
   }

   // Display the specified resource
   public function show($id)
   {
       $bitacora = Bitacora::findOrFail($id);
       return response()->json($bitacora);
   }

   // Update the specified resource in storage
   public function update(Request $request, $id)
   {
       $request->validate([
           'timestamp' => 'required|date',
           'username' => 'required|string|max:255',
           'email' => 'required|string|email|max:255',
           'role' => 'required|string|max:255',
           'id_resource' => 'required|integer',
           'name_resource' => 'required|string|max:255',
           'actions' => 'required|string|max:255',
       ]);

       $bitacora = Bitacora::findOrFail($id);
       $bitacora->update($request->all());

       return response()->json($bitacora);
   }

   // Remove the specified resource from storage
   public function destroy($id)
   {
       $bitacora = Bitacora::findOrFail($id);
       $bitacora->delete();

       return response()->json(null, 204);
   }
}
