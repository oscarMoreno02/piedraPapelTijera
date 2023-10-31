<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Mano;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class ControladorPartida extends Controller
{
    function crearPartida(Request $request)
    {

        $partida = new Partida();
        $partida->usuario = $request->get('usuario');
        $partida->usuario2 = $request->get('usuario2');
        $partida->save();
        return response()->json(['Partida creada correctamente']);
    }

    function juegarRonda(Request $request)
    {
        $p = Partida::find($request->get('id_partida'));
        $mano = new Mano;
        $mano->idPartida = $p->id;
        $mano->mano_usuario1 = $request->get('mano_usuario1');
        $mano->mano_usuario2 = $request->get('mano_usuario2');
        $ganador = $this->quienGana($mano->mano_usuario1, $mano->mano_usuario2);
        if ($ganador == 1) {
            $mano->ganador = $p->usuario;
        }
        if ($ganador == 2) {
            $mano->ganador = $p->usuario2;
        }
        if ($ganador == 0) {
            $mano->ganador = '0';
        }
        $p->rondasRestantes -= 1;
        if ($p->rondas_restantes == 0) {
            $p->finalizada = 1;
        }
        $p->save();
        $mano->save();

        return response()->json([$mano]);
    }




    function quienGana($u1, $u2)
    {
        $ganador = 0;

        if ($u1 != $u2) {
            if ($u1 == 'piedra') {
                if ($u2 == 'papel') {
                    $ganador = 2;
                } else {
                    $ganador = 1;
                }
            }
            if ($u1 == 'papel') {
                if ($u2 == 'tijera') {
                    $ganador = 2;
                } else {
                    $ganador = 1;
                }
            }
            if ($u1 == 'tijera') {
                if ($u2 == 'piedra') {
                    $ganador = 2;
                } else {
                    $ganador = 1;
                }
            }
        }
        return $ganador;
    }
    public function consultarTodas()
    {
        $user = Partida::all();
        return response()->json(['respuesta' => $user]);
    }
    function consultarHistorialPartidasUsuario(Request $request)
    {
        $match = Partida::where('usuario', $request->get('id_usuario'))
    ->orWhere('usuario2','=', $request->get('id_usuario'));
        return response()->json(['respuesta' => $match]);
    }
    function rankingVictorias()
    {
        $ranking = Usuario::orderBy('partidas_ganadas', 'desc')->get(['partidas_ganadas', 'nombre']);

        return response()->json(['mensaje' => $ranking]);
    }
    function rankingJugadas()
    {
        $ranking = Usuario::orderBy('partidas_ganadas', 'desc')->get(['partidas_jugadas', 'nombre']);

        return response()->json(['mensaje' => $ranking]);
    }

    function rankingEmpate()
    {
        $ranking = DB::select('SELECT u.nombre, SUM(
            IF(u.id = p.usuario AND p.puntuacion_usuario2 = p.puntuacion_usuario, 1,0)
            + IF(u.id = p.usuario2 AND p.puntuacion_usuario = p.puntuacion_usuario2, 1, 0)) as partidas_empatadas
        FROM usuario u JOIN partida p ON u.id = p.usuario
        OR u.id = p.usuario2
        GROUP BY u.id, u.nombre
         ORDER BY partidas_empatadas DESC;');

   function rankingPerdidas()
   {
       $ranking = DB::select('SELECT u.nombre, SUM(
        IF(u.id = p.usuario AND p.puntuacion_usuario2 > p.puntuacion_usuario, 1,0)
       + IF(u.id = p.usuario2 AND p.puntuacion_usuario > p.puntuacion_usuario2, 1, 0)) as partidas_perdidas
       FROM usuario u JOIN partida p ON u.id = p.usuario
       OR u.id = p.usuario2
       GROUP BY u.id, u.nombre
        ORDER BY partidas_perdidas DESC;');

        return response()->json(['mensaje' => $ranking]);
    }



}
}
