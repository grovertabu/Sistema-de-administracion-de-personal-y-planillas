<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominaCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina_cargos', function (Blueprint $table) {
            $table->id();
            $table->integer('item')->nullable();
            $table->unsignedBigInteger('tipo_contrato_id');
            $table->unsignedBigInteger('unidad_organizacional_id');
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('escala_salarial_id');
            $table->foreign('tipo_contrato_id')
                ->references('id')
                ->on('tipo_contratos')
                ->onUpdate('cascade');

            $table->foreign('unidad_organizacional_id')
                ->references('id')
                ->on('unidad_organizacionals')
                ->onUpdate('cascade');

            $table->foreign('cargo_id')
                ->references('id')
                ->on('cargos')
                ->onUpdate('cascade');

            $table->foreign('escala_salarial_id')
                ->references('id')
                ->on('escala_salarials')
                ->onUpdate('cascade');
            $table->string('estado', 20);
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
        Schema::dropIfExists('nomina_cargos');
    }
}
