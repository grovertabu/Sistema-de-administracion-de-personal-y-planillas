<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstructuraOrganizacionalsTable extends Migration
{

    public function up()
    {
        Schema::create('estructura_organizacionals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->integer('version');
            $table->string('estado',20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estructura_organizacionals');
    }
}
