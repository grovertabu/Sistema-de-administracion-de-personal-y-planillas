<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meritos', function (Blueprint $table) {
            $table->id();
            $table->string('detalle_merito',50);
            $table->date('fecha_merito');
            $table->text('file_merito')->nullable();
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
        Schema::dropIfExists('meritos');
    }
}
