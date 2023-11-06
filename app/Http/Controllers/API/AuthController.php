<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['nombre' => $request->nombre, 'password' => $request->password])){
            $auth = Auth::user();
            //return $auth;
            $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            $success['nombre'] =  $auth->nombre;

            return response()->json(["success"=>true,"data"=>$success, "message" => "User logged-in!"]);
        }
        else{
            return response()->json("Unauthorised",204);
        }
    }

    public function register(Request $request)
    {
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = Usuario::create($input);
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['nombre'] =  $user->nombre;

        return response()->json(["success"=>true,"data"=>$success, "message" => "User successfully registered!"]);
    }
    
     /**
     * Por defecto los tokens de Sanctum no expiran. Se puede modificar esto añadiendo una cantidad en minutos a la variable 'expiration' en el archivo de config/sanctum.php.
     */
     public function logout(Request $request)
    {
        if(Auth::attempt(['nombre' => $request->nombre, 'password' => $request->password])){
            $cantidad = Auth::user()->tokens()->delete();
            return response()->json(["success"=>true, "message" => "Tokens Revoked: ".$cantidad],200);
        }
        else {
            return response()->json("Unauthorised",204);
        }

    }
}
