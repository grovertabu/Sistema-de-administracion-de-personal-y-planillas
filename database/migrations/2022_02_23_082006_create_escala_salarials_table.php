<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscalaSalarialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escala_salarials', function (Blueprint $table) {
            $table->id();
            $table->integer('nivel');
            $table->string('descripcion',100);
            $table->integer('casos');
            $table->float('salario_mensual',9,2);
            $table->string('estado',20);
            $table->unsignedBigInteger('estructura_organizacional_id');
            $table->foreign('estructura_organizacional_id')
                    ->references('id')
                    ->on('estructura_organizacionals')
                    ->onUpdate('cascade');
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
        Schema::dropIfExists('escala_salarials');
    }
}
