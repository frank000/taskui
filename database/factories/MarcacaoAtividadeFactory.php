<?php

namespace Database\Factories;

use App\Models\MarcacaoAtividade;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MarcacaoAtividadeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MarcacaoAtividade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'atividade_id' => 31,
            'user_id' => 1,
            'flg_situacao' => 'A',
            'flg_aberto' => 'F',
            'dat_marcacao' => $this->faker->date(),
        ];
    }
}
