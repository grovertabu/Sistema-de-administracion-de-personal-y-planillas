<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_cargos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_ingreso');
            $table->date('fecha_nuevo_cargo')->nullable();
            $table->date('fecha_conclusion')->nullable();
            $table->string('observacion',150)->nullable();
            $table->string('motivo_baja',150)->nullable();
            $table->enum('aporte_afp', ['SI', 'NO'])->default('NO');
            $table->enum('sindicato', ['SI', 'NO'])->default('NO');
            $table->enum('socio_fe', ['SI', 'NO'])->default('NO');
            $table->unsignedBigInteger('trabajador_id');
            $table->unsignedBigInteger('nomina_cargo_id');

            $table->foreign('trabajador_id')
                ->references('id')
                ->on('trabajadors')
                ->onUpdate('cascade');

            $table->foreign('nomina_cargo_id')
                ->references('id')
                ->on('nomina_cargos')
                ->onUpdate('cascade');

            $table->string('estado',20);
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
        Schema::dropIfExists('asignacion_cargos');
    }
}
