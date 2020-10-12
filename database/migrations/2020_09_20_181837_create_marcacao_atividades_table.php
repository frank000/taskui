<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcacaoAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcacao_atividades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
           // $table->integer('atividade_id')->unsigned();
            $table->unsignedBigInteger('atividade_id')->references('id')->on('atividades');
          //  $table->integer('user_id')->unsigned();
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->nullable(true);
            $table->string('flg_situacao', 1)->nullable(false)->comment('A = ativo, I = Inativo');
            $table->string('flg_aberto', 1)->default('A')->nullable(false)->comment('A = aberto, F = Fechado');
            $table->dateTime('dat_marcacao')->nullable(false)->comment('Data e hora da marcação');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marcacao_atividades');
    }
}
