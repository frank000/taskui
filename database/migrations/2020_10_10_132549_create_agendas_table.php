<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // $table->integer('atividade_id')->unsigned();
            $table->unsignedBigInteger('atividade_id')->references('id')->on('atividades');
            $table->unsignedBigInteger('resource_id')->references('id')->on('resources');
            //  $table->integer('user_id')->unsigned();
            $table->unsignedBigInteger('client_id')->references('id')->on('clients')->nullable(true);
            $table->string('flg_situacao', 1)->nullable(false)->comment('A = ativo, I = Inativo');
            $table->string('color')->default('#F8F8FF')->nullable()->comment('Cor para o backgroud do evento');
            $table->string('flg_aberto', 1)->default('A')->nullable(false)->comment('A = aberto, F = Fechado, C = Cancelado');
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
        Schema::dropIfExists('agendas');
    }
}
