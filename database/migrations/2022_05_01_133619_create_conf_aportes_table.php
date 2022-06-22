<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfAportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_aportes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_aporte',100);
            $table->integer('rango_inicial');
            $table->integer('rango_final');
            $table->float('porcentaje_aporte',9,2);
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
        Schema::dropIfExists('conf_aportes');
    }
}
