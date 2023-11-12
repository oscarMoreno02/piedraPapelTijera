<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ControladorUsuario extends Controller
{
    public function listarTodos(){
        $user=User::all();
        return response()->json(['respuesta'=>$user]);
    
    }

  public function listar(Request $request){
    $user=User::find([$request->get('id')]);
    return response()->json(['respuesta'=>$user]);

}
public  function actualizarPassword(Request $request){
    $user=User::find([$request->get('idUpdate')]);
    $user->password=$request->get('newPassword');
    $user->Save();
    return response()->json(['respuesta'=>$user]);
}
public  function actualizarNombre(Request $request){
    $user=User::find([$request->get('idUpdate')]);
    $user->nombre=$request->get('newNombre');
    $user->Save();
    return response()->json(['respuesta'=>$user]);
}
public  function actualizarRol(Request $request){
    $user=User::find([$request->get('idUpdate')]);
    $user->rol=$request->get('newRol');
    $user->Save();
    return response()->json(['respuesta'=>$user]);
}

public  function insertar(Request $request){
    $user= new User();
    $user->nombre=$request->get('newNombre');
    $user->email=$request->get('newEmail');
    $user->password=$request->get('newPassword');
    $user->Save();
    return response()->json(['respuesta'=>$user]);
}

public function delete(Request $request){
    $user = User::find($request->get('id_usuario')); $user->delete();
}

}
