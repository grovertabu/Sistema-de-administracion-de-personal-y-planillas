<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->id();
            $table->string('ci',10);
            $table->string('complemento',4)->nullable();
            $table->string('expedido',20);
            $table->string('nro_asegurado',15);
            $table->string('nombre',50);
            $table->string('apellido_paterno',40);
            $table->string('apellido_materno',40)->nullable();
            $table->string('direccion',40);
            $table->string('tipo_sangre',40)->nullable();
            $table->string('telefono',40)->nullable();
            $table->string('celular',40)->nullable();
            $table->string('estado_civil',50)->default('NONE');
            $table->string('sexo', 1);
            $table->string('nacionalidad',40);
            $table->date('fecha_nacimiento');
            $table->integer('antiguedad_anios');
            $table->integer('antiguedad_meses');
            $table->integer('antiguedad_dias');
            $table->string('foto',100)->nullable();
            $table->string('estado_trabajador',25);
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
        Schema::dropIfExists('trabajadors');
    }
}
