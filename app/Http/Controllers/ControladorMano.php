<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use APp\Models\Mano;

class ControladorMano extends Controller
{
    function consultarTodasLasManos()
    {

        $manos = Mano::all();
        return response()->json(['mensaje' => $manos]);
    }
    function consultarManosUsuario(Request $request)
    {
        $manos = DB::select(
            'select * from mano where id_partida in (select id from partida where usuario = ? or usuario2 = ?',
            [$request->get('idUsuario'), $request->get('idUsuario')]
        );
        return response()->json(['mensaje' => $manos]);
    }
    function consultarManosPartida(Request $request)
    {
        $manos = Mano::where('id_partida', '=', $request->get('idPartida'));
        return response()->json(['mensaje' => $manos]);
    }

    function rankingManosGanadoras()
    {
        $ranking = DB::select("SELECT 'piedra' AS opcion,
        SUM( (mano_usuario1 = 'piedra' AND mano_usuario2 = 'tijera')
        OR (mano_usuario1 = 'tijera' AND mano_usuario2 = 'piedra') )
        AS total_ganadas, COUNT(*) AS total_partidas FROM mano
        
        UNION

        SELECT 'papel' AS opcion,
         SUM( (mano_usuario1 = 'papel' AND mano_usuario2 = 'piedra')
         OR (mano_usuario1 = 'piedra' AND mano_usuario2 = 'papel') )
          AS total_ganadas, COUNT(*) AS total_partidas FROM mano

          UNION
          
           SELECT 'tijera' AS opcion,
           SUM( (mano_usuario1 = 'tijera' AND mano_usuario2 = 'papel')
           OR (mano_usuario1 = 'papel' AND mano_usuario2 = 'tijera') )
           AS total_ganadas, COUNT(*) AS total_partidas FROM mano ORDER BY total_ganadas DESC;");

           return response()->json(['mensaje'=>$ranking]);
    }

    function rankingManosPerdedoras(){
        $ranking = DB::select("SELECT 'piedra' AS opcion,
        SUM( (mano_usuario1 = 'piedra' AND mano_usuario2 = 'papel')
        OR (mano_usuario1 = 'papel' AND mano_usuario2 = 'piedra') )
        AS total_ganadas, COUNT(*) AS total_partidas FROM manos
        
        UNION 

        SELECT 'papel' AS opcion,
         SUM( (mano_usuario1 = 'papel' AND mano_usuario2 = 'tijera')
         OR (mano_usuario1 = 'tijera' AND mano_usuario2 = 'papel') )
          AS total_ganadas, COUNT(*) AS total_partidas FROM manos

          UNION
          
           SELECT 'tijera' AS opcion,
           SUM( (mano_usuario1 = 'tijera' AND mano_usuario2 = 'piedra')
           OR (mano_usuario1 = 'piedra' AND mano_usuario2 = 'tijera') )
           AS total_ganadas, COUNT(*) AS total_partidas FROM manos ORDER BY opcion;");

           return response()->json(['mensaje'=>$ranking]);

    }
    function rankingManosNulas(){
        $ranking = DB::select("SELECT 'piedra' AS opcion,
        SUM( (mano_usuario1 = 'piedra' AND mano_usuario2 = 'piedra') )
        AS total_ganadas, COUNT(*) AS total_partidas FROM manos
        
        UNION

        SELECT 'papel' AS opcion,
         SUM( (mano_usuario1 = 'papel' AND mano_usuario2 = 'papel')  )
          AS total_ganadas, COUNT(*) AS total_partidas FROM manos

          UNION
          
           SELECT 'tijera' AS opcion,
           SUM( (mano_usuario1 = 'tijera' AND mano_usuario2 = 'tijera') )
           AS empates, COUNT(*) AS total_partidas FROM manos ORDER BY opcion;");

           return response()->json(['mensaje'=>$ranking]);

    }
    function rankingManosMasJugadas(){
        $ranking = DB::select("SELECT 'piedra' AS opcion, 
        SUM( (mano_usuario1 = 'piedra' AND mano_usuario2 = 'piedra') ) 
        AS total_ganadas, COUNT(*) AS total_partidas FROM manos 
        
        UNION 

        SELECT 'papel' AS opcion,
         SUM( (mano_usuario1 = 'papel' AND mano_usuario2 = 'papel')  )
          AS total_ganadas, COUNT(*) AS total_partidas FROM manos 

          UNION
          
           SELECT 'tijera' AS opcion,
           SUM( (mano_usuario1 = 'tijera' AND mano_usuario2 = 'tijera') )
           AS empates, COUNT(*) AS total_partidas FROM manos ORDER BY opcion;");

           return response()->json(['mensaje'=>$ranking]);

    }



}
