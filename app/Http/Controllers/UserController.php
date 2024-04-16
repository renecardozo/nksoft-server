<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(UserResource::collection(User::all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'ci' => 'required|unique:users,ci',
            'code_sis' => 'required|unique:users,code_sis',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'role_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'Error al crear usuario', 'error' => $validator->errors()], 400);
        } else {
            User::create($request->all());
            return response()->json(['success' => true, 'message' => 'Usuario creado exitosamente'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (@User::find($id) == null) {
            return response()->json(['error' => true, 'message' => 'User not found'], 404);
        }
        return response()->json(@User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'ci' => 'required|unique:users,ci,'.$id,
            'code_sis' => 'required|unique:users,code_sis,'.$id,
            'email' => 'required|unique:users,email,'.$id,
            'phone' => 'required',
            'role_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'Error al actualizar usuario', 'error' => $validator->errors()], 400);
        } else {
            User::where('id', $id)->update($request->all());
            return response()->json(['success' => true, 'message' => 'Usuario actualizado exitosamente'], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (@User::find($id) == null) {
            return response()->json(['error' => true, 'message' => 'User not found'], 404);
        }
        User::find($id)->delete();
        return response()->json(['success' => true, 'message' => 'Usuario eliminado exitosamente'], 201);
    }
}
