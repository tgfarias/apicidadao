<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable(false);
            $table->string('lastname', 100)->nullable(false);
            $table->string('cpf', 11)->unique()->nullable(false);
            $table->string('phone', 10)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('cellphone', 11)->nullable();
            $table->string('postalcode', 8)->nullable();
            $table->string('plane', 150)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 2)->nullable();
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
        Schema::dropIfExists('persons');
    }
}
