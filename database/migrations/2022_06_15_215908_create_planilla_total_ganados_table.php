<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaTotalGanadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla_total_ganados', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->integer('gestion');
            $table->integer('tipo_contrato');
            $table->decimal('total_dias',9,2);
            $table->decimal('haber_mensual',9,2);
            $table->decimal('haber_basico',9,2);
            $table->decimal('bono_antiguedad',9,2);
            $table->decimal('horas_extra',9,2);
            $table->decimal('monto_horas_extra',9,2);
            $table->decimal('suplencia',9,2);
            $table->decimal('total_ganado',9,2);
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
        Schema::dropIfExists('planilla_total_ganados');
    }
}
