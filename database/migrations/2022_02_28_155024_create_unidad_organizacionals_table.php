<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadOrganizacionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_organizacionals', function (Blueprint $table) {
            $table->id();
            $table->string('seccion',100);
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
        Schema::dropIfExists('unidad_organizacionals');
    }
}
