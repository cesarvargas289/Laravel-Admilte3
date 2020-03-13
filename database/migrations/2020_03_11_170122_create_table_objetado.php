<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableObjetado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folio_seg')->nullable();
            $table->date('fecha_solicitud')->nullable();
            $table->date('fecha_instalacion')->nullable();
            $table->string('estatus_seg')->nullable();
            $table->date('fecha_objecion')->nullable();
            $table->longText('motivo_objecion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('objetados');
    }
}
