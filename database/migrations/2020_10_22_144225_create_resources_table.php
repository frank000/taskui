<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->nullable(true);
            $table->string('str_name')->nullable(false)->unique();
            $table->unsignedBigInteger('type_resource_id')->references('id')->on('type_resources');
            $table->string('flg_sit', 1)->default('A')->nullable(false)->comment('A = ativo, I = Inativo');
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
        Schema::dropIfExists('resources');
    }
}
