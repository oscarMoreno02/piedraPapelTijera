<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
class ControladorUsuario extends Controller
{
    public function listarTodos(){
        $user=Usuario::all();
        return response()->json(['respuesta'=>$user]);
    
    }

  public function listar(Request $request){
    $user=Usuario::find([$request->get('id')]);
    return response()->json(['respuesta'=>$user]);

}
public  function actualizarPassword(Request $request){
    $user=Usuario::find([$request->get('idUpdate')]);
    $user->password=$request->get('newPassword');
    $user->Save();
    return response()->json(['respuesta'=>$user]);
}
public  function actualizarNombre(Request $request){
    $user=Usuario::find([$request->get('idUpdate')]);
    $user->nombre=$request->get('newNombre');
    $user->Save();
    return response()->json(['respuesta'=>$user]);
}
public  function actualizarRol(Request $request){
    $user=Usuario::find([$request->get('idUpdate')]);
    $user->rol=$request->get('newRol');
    $user->Save();
    return response()->json(['respuesta'=>$user]);
}

public  function insertar(Request $request){
    $user= new Usuario();
    $user->nombre=$request->get('newNombre');
    $user->password=$request->get('newPassword');
    $user->Save();
    return response()->json(['respuesta'=>$user]);
}

public function delete(Request $request){
    $user = Usuario::find($request->get('id')); $user->delete();
}

}
