<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_personals', function (Blueprint $table) {
            $table->id();
            $table->string('detalle_documento',50);
            $table->date('fecha_registro');
            $table->string('tipo_documento',50);
            $table->text('file_documento')->nullable();
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
        Schema::dropIfExists('documento_personals');
    }
}
