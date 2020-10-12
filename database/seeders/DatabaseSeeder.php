<?php

namespace Database\Seeders;

use App\Models\Atividade;
use App\Models\MarcacaoAtividade;
use App\Models\SemanaPeriodo;
use App\Models\User;
use Database\Factories\MarcacaoAtividadeFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        MarcacaoAtividade::factory(2)->create();
//        $ati = Atividade::factory(2)
//            ->has(SemanaPeriodo::factory()->count(5)->state(function (array $attributes, Atividade $ati) {
//                return ['atividade_id' => $ati->id];
//            }))
//            ->for(User::factory())
//            ->create();
//        dd($ati);
//
//         $users = User::factory(10)->create();
//            echo
//        $users->each(function ($user){
//            echo 'a================== ' . $user->id;
//                $ati = Atividade::factory(2)
//                    ->has(SemanaPeriodo::factory()->count(5)->state(function (array $attributes, Atividade $ati) {
//                        return ['atividade_id' => $ati->id];
//                    }))
//                    ->for(User::factory())
//                    ->create();
//            dd($ati);
//
//
//         });




    }
}
