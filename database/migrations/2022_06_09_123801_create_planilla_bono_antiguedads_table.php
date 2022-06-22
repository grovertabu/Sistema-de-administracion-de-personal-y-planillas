<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaBonoAntiguedadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla_bono_antiguedads', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->integer('gestion');
            $table->integer('tipo_contrato');
            $table->integer('anios_arrastre');
            $table->integer('meses_arrastre');
            $table->integer('dias_arrastre');
            $table->date('fecha_ingreso');
            $table->date('fecha_calculo');
            $table->integer('anios_actual');
            $table->integer('meses_actual');
            $table->integer('dias_actual');
            $table->decimal('porcentaje',9,2);
            $table->decimal('monto',9,2);
            $table->unsignedBigInteger('asignacion_cargo_id');
            $table->foreign('asignacion_cargo_id')
                ->references('id')
                ->on('asignacion_cargos')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('planilla_bono_antiguedads');
    }
}
