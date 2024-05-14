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
        $userRes = new UserResource(User::find($id));
        $rol = [
            "name"=>($userRes->getRoleNames())[0],
        ];
        $userReturn = [
            "id" => 2,
            "name" =>$userRes->name ,
            "email" => $userRes->email,
            "last_name" => $userRes->last_name,
            "ci" => $userRes->ci,
            "code_sis" => $userRes->code_sis,
            "phone" => $userRes->phone,
            'role' => $rol,
            'permissions' => $userRes->getAllPermissions()->toArray()
        ];
        return response()->json($userReturn);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        // Find the user by email
        $user = User::where('password', $password)->where('email', $email)->first();
        echo  "\n";
        if (!$user) {
            // Authentication failed...
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // Authentication passed...
        $userRes = new UserResource(User::find($user['id']));
        $rol = [
            "name"=>($userRes->getRoleNames())[0],
        ];
        $userReturn = [
            "id" => 2,
            "name" =>$userRes->name ,
            "email" => $userRes->email,
            "last_name" => $userRes->last_name,
            "ci" => $userRes->ci,
            "code_sis" => $userRes->code_sis,
            "phone" => $userRes->phone,
            'role' => $rol,
            'permissions' => $userRes->getAllPermissions()->toArray()
        ];
        return response()->json($userReturn);
        
    }
}
