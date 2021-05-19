<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosubprocesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadosubprocesos', function (Blueprint $table) {
            $table->id();
            $table->String('estado');
            $table->date('fecha');
            $table->bigInteger('sub_procesos_id')->unsigned();
            $table->foreign('sub_procesos_id')->references('id')->on('sub_procesos')->onDelete('cascade');
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
        Schema::dropIfExists('estadosubprocesos');
    }
}
