<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfImpositivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_impositivas', function (Blueprint $table) {
            $table->id();
            $table->decimal('salario_minimo',9,2);
            $table->integer('cantidad_salario_minimo');
            $table->decimal('porcentaje_impositiva',9,2);
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
        Schema::dropIfExists('conf_impositivas');
    }
}
