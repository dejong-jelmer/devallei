<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoachdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coachdatas', function(Blueprint $table){
            $table->increments('id');
            $table->integer('coach_id');
            $table->string('voornaam')->null();
            $table->string('tussenvoegsel')->null();
            $table->string('achternaam')->null();
            $table->string('email')->null();
            $table->string('telefoon')->null();
            $table->string('mobiel')->null();
            $table->string('straat')->null();
            $table->string('huisnummer')->null();
            $table->string('postcode')->null();
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
        Schema::dropIfExists('coachdatas');
    }
}
