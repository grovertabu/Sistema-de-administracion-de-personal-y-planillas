<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfBonoAntiguedadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_bono_antiguedads', function (Blueprint $table) {
            $table->id();
            $table->integer('anio_i');
            $table->integer('anio_f');
            $table->decimal('porcentaje',9,2);
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
        Schema::dropIfExists('conf_bono_antiguedads');
    }
}
