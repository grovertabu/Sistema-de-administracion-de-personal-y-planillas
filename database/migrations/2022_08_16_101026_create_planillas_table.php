<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planillas', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->integer('gestion');
            $table->integer('tipo_contrato')->default(1);
            $table->integer('item');
            $table->string('ci',15);
            $table->string('nua',12);
            $table->string('nombres',150);
            $table->string('apellidos',150);
            $table->string('cargo',200);
            $table->date('fecha_ingreso');
            $table->integer('dias_pagados');
            $table->decimal('haber_mensual',9,2);
            $table->decimal('haber_basico',9,2);
            $table->decimal('bono_antiguedad',9,2);
            $table->decimal('horas_extra',9,2);
            $table->decimal('suplencia',9,2);
            $table->decimal('total_ganado',9,2);
            $table->decimal('sindicato',9,2);
            $table->decimal('categoria_individual',9,2);
            $table->decimal('prima_riesgo_comun',9,2);
            $table->decimal('comision_ente',9,2);
            $table->decimal('total_aporte_solidario',9,2);
            $table->decimal('desc_rciva',9,2);
            $table->decimal('otros_descuentos',9,2);
            $table->decimal('fondo_social',9,2);
            $table->decimal('fondo_empleados',9,2);
            $table->decimal('entidades_financieras',9,2);
            $table->decimal('total_descuentos',9,2);
            $table->decimal('liquido_pagable',9,2);
            $table->date('fecha_aprobado');
            $table->enum('estado', ['APROBADO', 'REPROBADO','GENERADO'])->default('GENERADO');
            $table->timestamps();
            $table->unsignedBigInteger('nombre_planilla_id');
            $table->foreign('nombre_planilla_id')
                ->references('id')
                ->on('nombre_planillas')
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
        Schema::dropIfExists('planillas');
    }
}
