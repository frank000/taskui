<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('str_atividade', 100)->nullable(false);
            $table->string('str_desc', 200)->nullable(false);
            $table->integer('temp_periodo')->nullable(false)->comment('Valor em minutos da duraçã́o de cada atividade');
            $table->string('str_img', 200)->nullable()->comment('Imagem para referencia da atividade ');
            $table->date('dat_inicio')->comment('Data de inicio de validade de uma atividade');
            $table->date('dat_fim')->nullable(true)->comment('Data de finalização de validade de uma atividade');
            $table->string('flg_situacao', 1)->nullable(false)->comment('A = ativo, I = Inativo');
           // $table->integer('semana_periodo_id')->unsigned()->comment('Relação dos dias da semanda que a atividade é diponibilizada');
            //$table->unsignedBigInteger('semana_periodo_id')->references('id')->on('semana_periodos')->comment('Relação dos dias da semanda que a atividade é diponibilizada');
          //  $table->integer('user_id')->unsigned()->comment('Id do criador');
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->comment('Id do criador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividades');
    }
}
