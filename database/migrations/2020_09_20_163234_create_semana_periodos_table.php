<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemanaPeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semana_periodos', function (Blueprint $table) {
            $table->id();
            //$table->integer('atividade_id')->unsigned()->comment('Atividade a qual o dia pertencie');
            $table->unsignedBigInteger('atividade_id')->references('id')->on('atividades')->comment('Atividade a qual o dia pertencie');
            $table->unsignedBigInteger('resource_id')->references('id')->on('resources')
                ->nullable(false)->comment('Resource a qual o dia pertencie');
            $table->timestamps();
            $table->integer('num_dia')->nullable(false)->comment("'dom'=> 0,'seg' => 1 , 'ter' => 2, 'qua' => 3, 'qui' => 4,
                  'sex' => 5, 'sab' => 6");
            $table->time("hor_inicio_man")->comment('Hora de inicio-manhã para o dia');
            $table->time("hor_fim_man")->comment('Hora de terminio-manhã para o dia');
            $table->time("hor_inicio_tar")->comment('Hora de inicio-tarde para o dia');
            $table->time("hor_fim_tar")->comment('Hora de terminio-tarde para o dia');
            $table->string('flg_situacao', 1)->nullable(false)->comment('A = ativo, I = Inativo');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semana_periodos');
    }
}
