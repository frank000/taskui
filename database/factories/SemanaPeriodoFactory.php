<?php

namespace Database\Factories;

use App\Models\Atividade;
use App\Models\SemanaPeriodo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SemanaPeriodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SemanaPeriodo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return ['atividade_id' => Atividade::factory(),
            'num_dia' => $this->faker->randomElement([0 ,1 ,2 ,3, 4, 5, 6]),
            'hor_inicio' => $this->faker->time() ,
            'hor_fim' => $this->faker->time(),
            'flg_situacao' => $this->faker->randomElement(['A','I']),
            ];
    }
}
