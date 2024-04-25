<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $codeSis = $request['code_sis'];
        $cii = $request['ci'];

        // Find the user by email
        $user = User::where('ci', $cii)->where('code_sis', $codeSis)->first();
        if (!$user) {
            // Authentication failed...
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $id = $user['id'];
        if (@User::find($id) == null) {
            return response()->json(['error' => true, 'message' => 'User not found'], 404);
        }
        // Authentication passed...
        return response()->json(new UserResource(User::find($id)));
    }

}
