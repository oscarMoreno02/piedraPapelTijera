<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $auth = Auth::user();
            $persona = DB::select('select rol from users where email = ? ', [$request->get('email')]);
            if ($persona[0]->rol) {
               $success['token'] =  $auth->createToken('access_token',["admin"])->plainTextToken;
            } else {
                $success['token'] =  $auth->createToken('access_token',["user"])->plainTextToken;
            }
           
            $success['nombre'] =  $auth->nombre;

            return response()->json(["success"=>true,"data"=>$success, "message" => "User logged-in!"]);
        }
        else{
            return response()->json("Unauthorised",204);
        }
    }

    public function register(Request $request)
    {
        $messages = [
            'email.unique' => 'Ese correo ya existe en la bd',
            'nombre.unique' => 'Ese nombre ya existe en la bd',
            'email' => 'El campo no se ajusta a un correo estándar',
            'same' => 'Los campos :password y :confirm_password deben coincidir',
            'max' => 'El campo se excede del tamaño máximo',
            'between' => 'El campo :edad no está entre :18,100'
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:20|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ], $messages);

        if($validator->fails()){
            return response()->json($validator->errors(),202);
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['name'] =  $user->name;

        return response()->json(["success" => true, "data" => $success, "message" => "User successfully registered!"]);
    }
    
  
     public function logout(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $cantidad = Auth::user()->tokens()->delete();
            return response()->json(["success"=>true, "message" => "Tokens Revoked: ".$cantidad],200);
        }
        else {
            return response()->json("Unauthorised",204);
        }

    }
}
