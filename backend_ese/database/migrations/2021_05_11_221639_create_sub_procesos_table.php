<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_procesos', function (Blueprint $table) {
            $table->id();
            $table->String('nombre');
            $table->String('hora_estimada');
            $table->String('estado');
            $table->bigInteger('procesos_id')->unsigned();
            $table->foreign('procesos_id')->references('id')->on('procesos')->onDelete('cascade');
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
        Schema::dropIfExists('sub_procesos');
    }
}
