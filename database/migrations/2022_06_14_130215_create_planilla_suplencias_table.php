<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaSuplenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla_suplencias', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->integer('gestion');
            $table->integer('tipo_contrato');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('total_dias',9,2);
            $table->decimal('salario_mensual',9,2);
            $table->decimal('monto',9,2);
            $table->string('cargo_suplencia',150);
            $table->text('motivo')->nullable();
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
        Schema::dropIfExists('planilla_suplencias');
    }
}
