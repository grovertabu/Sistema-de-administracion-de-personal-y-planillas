<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaImpositivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla_impositivas', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->integer('gestion');
            $table->integer('tipo_contrato');
            $table->decimal('ufv_actual',9,5);
            $table->decimal('ufv_pasado',9,5);
            $table->decimal('total_ganado',9,2);
            $table->decimal('aportes_laborales',9,2);
            $table->decimal('sueldo_neto',9,2);
            $table->decimal('minimo_no_imponible',9,2);
            $table->decimal('base_imponible',9,2);
            $table->decimal('impuesto_bi',9,2);
            $table->decimal('presentacion_desc',9,2);
            $table->decimal('impuesto_mn',9,2);
            $table->decimal('saldo_dependiente',9,2);
            $table->decimal('saldo_fisco',9,2);
            $table->decimal('saldo_mes_anterior',9,2);
            $table->decimal('actualizacion',9,2);
            $table->decimal('saldo_total_mes_anterior',9,2);
            $table->decimal('saldo_total_dependiente',9,2);
            $table->decimal('saldo_utilizado',9,2);
            $table->decimal('retencion_pagar',9,2);
            $table->decimal('saldo_siguiente_mes',9,2);
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
        Schema::dropIfExists('planilla_impositivas');
    }
}
