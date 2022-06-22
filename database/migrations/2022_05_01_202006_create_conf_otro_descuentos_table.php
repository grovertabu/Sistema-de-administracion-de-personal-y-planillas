<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfOtroDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_otro_descuentos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',100);
            $table->string('factor_calculado',100);
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
        Schema::dropIfExists('conf_otro_descuentos');
    }
}
