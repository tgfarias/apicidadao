<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContactsPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('person_id');
            $table->foreign('person_id')->references('id')->on('persons');

            //$table->enum('type', ['phone', 'email', 'cellphone'])->nullable(false);

            $table->string('phone', 10)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('cellphone', 11)->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
