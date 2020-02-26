<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidadaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidadaos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100)->nullable(false);
            $table->string('sobrenome', 100)->nullable(false);
            $table->string('cpf', 11)->unique()->nullable(false);
            $table->string('cep', 8)->nullable();
            $table->string('logradouro', 150)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('uf', 2)->nullable();
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
        Schema::dropIfExists('cidadaos');
    }
}
