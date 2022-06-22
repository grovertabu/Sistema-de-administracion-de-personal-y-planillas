<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaHorasExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla_horas_extras', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->integer('gestion');
            $table->integer('tipo_contrato');
            $table->string('tipo_hora_extra',50);
            $table->decimal('factor_calculo',9,2);
            $table->decimal('cantidad',9,2);
            $table->decimal('monto',9,2);
            $table->unsignedBigInteger('asignacion_cargo_id');
            $table->timestamps();
            $table->foreign('asignacion_cargo_id')
                ->references('id')
                ->on('asignacion_cargos')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planilla_horas_extras');
    }
}
