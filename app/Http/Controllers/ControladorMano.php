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
        $ranking = DB::select(" WITH TOTALES AS (
        SELECT 'piedra' AS opcion,
        SUM( (mano_usuario1 = 'piedra' AND mano_usuario2 = 'tijera')
        OR (mano_usuario1 = 'tijera' AND mano_usuario2 = 'piedra') )
        AS total_ganadas, COUNT(*) AS total_partidas FROM mano
        where mano_usuario1='piedra' or mano_usuario2='piedra'
        UNION

        SELECT 'papel' AS opcion,
         SUM( (mano_usuario1 = 'papel' AND mano_usuario2 = 'piedra')
         OR (mano_usuario1 = 'piedra' AND mano_usuario2 = 'papel') )
          AS total_ganadas, COUNT(*) AS total_partidas FROM mano
          where mano_usuario1='papel' or mano_usuario2='papel'
          UNION
          
           SELECT 'tijera' AS opcion,
           SUM( (mano_usuario1 = 'tijera' AND mano_usuario2 = 'papel')
           OR (mano_usuario1 = 'papel' AND mano_usuario2 = 'tijera') )
           AS total_ganadas, COUNT(*) AS total_partidas FROM mano
           where mano_usuario1='tijera' or mano_usuario2='tijera'
           )
           SELECT
            opcion,
            total_ganadas,
            total_partidas,
            (total_ganadas * 100.0) / total_partidas AS porcentaje
            FROM TOTALES
            ORDER BY total_ganadas DESC");

        return response()->json(['mensaje' => $ranking]);
    }

    function rankingManosPerdedoras()
    {
        $ranking = DB::select("WITH Totales AS (
            SELECT
              'piedra' AS opcion,
              SUM((mano_usuario1 = 'piedra' AND mano_usuario2 = 'papel') OR (mano_usuario1 = 'papel' AND mano_usuario2 = 'piedra')) AS total_perdidas,
              COUNT(*) AS total_partidas
            FROM mano
            WHERE mano_usuario1 = 'piedra' OR mano_usuario2 = 'piedra'
            UNION
            SELECT
              'papel' AS opcion,
              SUM((mano_usuario1 = 'papel' AND mano_usuario2 = 'tijera') OR (mano_usuario1 = 'tijera' AND mano_usuario2 = 'papel')) AS total_perdidas,
              COUNT(*) AS total_partidas
            FROM mano
            WHERE mano_usuario1 = 'papel' OR mano_usuario2 = 'papel'
            UNION
            SELECT
              'tijera' AS opcion,
              SUM((mano_usuario1 = 'tijera' AND mano_usuario2 = 'piedra') OR (mano_usuario1 = 'piedra' AND mano_usuario2 = 'tijera')) AS total_perdidas,
              COUNT(*) AS total_partidas
            FROM mano
            WHERE mano_usuario1 = 'tijera' OR mano_usuario2 = 'tijera'
          )
          
          SELECT
            opcion,
            total_perdidas,
            total_partidas,
            (total_perdidas * 100.0) / total_partidas AS porcentaje
          FROM Totales
          ORDER BY total_perdidas DESC;
          ");

        return response()->json(['mensaje' => $ranking]);
    }
    function rankingManosNulas()
    {
        $ranking = DB::select(" WITH TOTALES AS (SELECT 'piedra' AS opcion,
        SUM( (mano_usuario1 = 'piedra' AND mano_usuario2 = 'piedra') )
        AS total_empatadas, COUNT(*) AS total_partidas FROM mano
        WHERE mano_usuario1 = 'piedra' OR mano_usuario2 = 'piedra'
        UNION

        SELECT 'papel' AS opcion,
         SUM( (mano_usuario1 = 'papel' AND mano_usuario2 = 'papel')  )
          AS total_empatadas, COUNT(*) AS total_partidas FROM mano
          WHERE mano_usuario1 = 'papel' OR mano_usuario2 = 'papel'
          UNION
          
           SELECT 'tijera' AS opcion,
           SUM( (mano_usuario1 = 'tijera' AND mano_usuario2 = 'tijera') )
           AS total_empatadas, COUNT(*) AS total_partidas FROM mano 
           WHERE mano_usuario1 = 'tijera' OR mano_usuario2 = 'tijera'
           )
           SELECT
            opcion,
            total_empatadas,
            total_partidas,
            (total_empatadas * 100.0) / total_partidas AS porcentaje
          FROM TOTALES
          ORDER BY total_empatadas DESC;");

        return response()->json(['mensaje' => $ranking]);
    }
    function rankingManosMasJugadas()
    {
        $ranking = DB::select(" WITH TOTALES AS (SELECT 'piedra' AS opcion,
        SUM( (mano_usuario1 = 'piedra' or mano_usuario2 = 'piedra') )
        AS total_jugadas, COUNT(*) AS total_partidas FROM mano
     
        UNION

        SELECT 'papel' AS opcion,
         SUM( (mano_usuario1 = 'papel' or mano_usuario2 = 'papel')  )
          AS total_jugadas, COUNT(*) AS total_partidas FROM mano
         
          UNION
          
           SELECT 'tijera' AS opcion,
           SUM( (mano_usuario1 = 'tijera' or mano_usuario2 = 'tijera') )
           AS total_jugadas, COUNT(*) AS total_partidas FROM mano 
           )
           SELECT
            opcion,
            total_jugadas,
            total_partidas,
            (total_jugadas * 100.0) / total_partidas AS porcentaje
          FROM TOTALES
          ORDER BY total_jugadas DESC;");

        return response()->json(['mensaje' => $ranking]);
    }
}
