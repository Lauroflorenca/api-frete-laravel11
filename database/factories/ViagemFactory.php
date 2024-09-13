<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Viagem;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Viagem>
 */
class ViagemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Viagem::class;
    public function definition(){
        return [
            'titulo' => $this->faker->word,
            'descricao' => $this->faker->sentence,
            'motorista' => $this->faker->name,
            'placa' => $this->faker->word,
            'dt_origem' => $this->faker->dateTime,
            'dt_destino' => $this->faker->dateTime,
            'origem' => $this->faker->word,
            'destino' => $this->faker->word,
            'conteudo' => $this->faker->paragraph,
            'ativo' => true,
        ];
    }
}
