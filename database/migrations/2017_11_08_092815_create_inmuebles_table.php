<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInmueblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero_catastral');
            $table->bigInteger('contribuyente_id')->unsigned();
            $table->string('direccion_inmueble');
            $table->string('medida_inmueble');
            $table->string('numero_escritura');
            $table->integer('metros_acera');
            $table->float('latitude', 20,  18);
            $table->float('longitude', 20, 18);
            $table->tinyInteger('estado');
            $table->foreign('contribuyente_id')->references('id')->on('contribuyentes');
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
        Schema::dropIfExists('inmuebles');
    }
}
