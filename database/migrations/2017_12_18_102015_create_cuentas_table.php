<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('numero_cuenta');
            $table->bigInteger('proyecto_id')->unsigned();
            $table->string('banco');
            $table->date('fecha_de_apertura');
            $table->double('monto_inicial',8,2);
            $table->integer('estado')->default(1);
            $table->date('fecha_de_reasignacion')->nullable();
            $table->string('motivo_reasignacion')->nullable();
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
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
        Schema::dropIfExists('cuentas');
    }
}
