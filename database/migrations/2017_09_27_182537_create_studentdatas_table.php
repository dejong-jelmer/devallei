<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentdatas', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("student_id");
            $table->string("leerlingnummer");
            $table->string("voornaam");
            $table->string("tussenvoegsel");
            $table->string("achternaam");
            $table->string("geboortedatum");
            $table->string("straat");
            $table->string("huisnummer");
            $table->string("huisnummer_toevoeging");
            $table->string("postcode");
            $table->string("woonplaats");
            $table->string("telefoon_1");
            $table->string("telefoon_2");
            $table->string("email");
            $table->string("ouder_verzorger_1");
            $table->string("ouder_verzorger_2");
            $table->string("aanwezig");
            $table->string("voogd");
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
        Schema::dropIfExists('studentdatas');
    }
}
