<?php

use App\Http\Controllers\ControladorUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControladorPartida;
use App\Http\Controllers\ControladorMano;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('admin')->middleware('AdminPass')->group(function () {
    Route::controller(ControladorUsuario::class)->group(function () {
        Route::get('all', 'listarTodos');

        Route::get('user/{id}', 'listar');

        Route::post('user', 'insertar');

        route::prefix('update')->group(function () {
            Route::put('username', 'actualizarNombre');
            Route::put('password', 'actualizarPassword');
            Route::put('rol', 'actualizarRol');
        });
        Route::delete('user', 'delete');
    });
});


Route::prefix('partida')->group(function () {
    Route::controller(ControladorPartida::class)->group(function () {

        Route::put('jugar', 'juegaRonda');

        Route::post('new', 'crearPartida');
        

        route::prefix('consultar')->group(function () {
            route::get('', 'consultarTodas');
            route::get('historial/usuario', 'consultarHistorialPartidasUsuario');
        });
        route::prefix('ranking')->group(function () {
            route::get('ganadas', 'rankingVictorias');
            route::get('perdidas', 'rankingPerdidas');
            route::get('jugadas', 'rankingJugadas');
            route::get('empates', 'rankingEmpates');
            
        });
      
    });
});


Route::prefix('manos')->group(function () {
    Route::controller(ControladorMano::class)->group(function () {

        Route::get('', 'consultarTodasLasManos');

        Route::post('usuario', 'consultarManosUsuario');
        
        route::get('partida','consultarManosPartida');
    


        route::prefix('estadisticas')->group(function () {
            route::get('ganadas', 'rankingManosGanadoras');
            route::get('perdidas', 'rankingManosPerdedoras');
            route::get('jugadas', 'rankingManosMasJugadas');
            route::get('empate', 'rankingNulas');
        });
      
    });
});