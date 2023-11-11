<?php

namespace Database\Factories;

use App\Http\Controllers\ControladorPartida;
use App\Models\aux\AuxPartida;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Partida;
use App\Models\Mano;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mano>
 */
class ManoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Mano::class;
    public function definition(): array
    {   
        
        $partida=Partida::find(AuxPartida::$IDPARTIDA);

        $user1=$partida->usuario;
        $user2=$partida->usuario2;

        $manoUsuario1=$this->faker->randomElement(['piedra', 'papel', 'tijera']);
        $manoUsuario2=$this->faker->randomElement(['piedra', 'papel', 'tijera']);

        $controller=new ControladorPartida;

        $resultado=$controller->quienGana($manoUsuario1,$manoUsuario2);

        if($resultado==1){
            $resultado=$user1;
        }else{
            if($resultado==2){
                $resultado=$user2;
            }
        }

        return [
            // 'id_partida' =>$id_partida,
            'mano_usuario1' => $manoUsuario1,
            'mano_usuario2' => $manoUsuario2,
            'ganador' => $resultado
        ];


    }
   
}
