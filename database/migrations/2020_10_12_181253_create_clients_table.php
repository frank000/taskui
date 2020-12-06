<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->nullable(true);
            $table->string('str_nome')->nullable(false);
            $table->string('str_email')->nullable();
            $table->string('num_telefone',20)->unique()->nullable(false)->comment('61981810000');
            $table->string('token')->nullable(true)->comment('json em base 64 contendo type, id, created');
            $table->string('flg_situacao', 1)->default('A')->nullable(false)->comment('A = ativo, I = Inativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
