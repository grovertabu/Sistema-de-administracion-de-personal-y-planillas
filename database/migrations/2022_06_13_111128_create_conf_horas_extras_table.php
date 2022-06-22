<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfHorasExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_horas_extras', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_hora_extra',50);
            $table->float('factor_calculo',9,2);
            $table->enum('estado', ['HABILITADO', 'INHABILITADO'])->default('HABILITADO');
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
        Schema::dropIfExists('conf_horas_extras');
    }
}
