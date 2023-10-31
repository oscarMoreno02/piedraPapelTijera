<?php

namespace Database\Factories;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\aux\AuxPartida;
use App\Models\Mano;
use App\Models\Partida;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partida>
 */
class PartidaFactory extends Factory
{
    protected $model = Partida::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario' =>$this->faker->randomElement(Usuario::get('id')),
            'usuario2' => $this->faker->randomElement(Usuario::get('id')),
            'puntuacion_usuario' => 0,
            'puntuacion_usuario2' => 0,
            'finalizada' => 1,
            'rondas_restantes' => 0
        ];
    }
    public function configure(): static
    {
        return 
        $this
        ->afterCreating(function ($partida, $faker) {
            $numeroPartes = rand(0,5); // Cambia esto al número deseado de partes por profesor.
            AuxPartida::$IDPARTIDA=$partida->id;
            Mano::factory($numeroPartes)->create(['id_partida' => $partida->id,]);
        })
      
        ;
    }
}
