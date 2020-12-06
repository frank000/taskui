<?php

namespace Database\Factories;

use App\Models\Atividade;
use App\Models\SemanaPeriodo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AtividadeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Atividade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return ['str_atividade'  => $this->faker->name,
            'str_desc'  => $this->faker->sentence,
            'temp_periodo'=> $this->faker->randomNumber(),
            'str_img'=> $this->faker->sentence,
            'dat_inicio'=> $this->faker->date(),
            'dat_fim'=> $this->faker->date(),
            'flg_situacao'=> $this->faker->randomElement(['A','I']),
            'user_id' => User::factory()->count(1),
            'semana_periodo_id' => SemanaPeriodo::factory()->count(5),

            ];

    }
}
