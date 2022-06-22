<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_curso',50);
            $table->string('institucion',50);
            $table->integer('horas_academicas');
            $table->date('fecha_curso');
            $table->text('file_curso')->nullable();
            $table->string('created_by',40)->nullable();
            $table->string('updated_by',40)->nullable();
            $table->unsignedBigInteger('trabajador_id');
            $table->foreign('trabajador_id')
                    ->references('id')
                    ->on('trabajadors')
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
        Schema::dropIfExists('cursos');
    }
}
