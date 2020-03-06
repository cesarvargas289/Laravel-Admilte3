<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seg', function (Blueprint $table) {
            $table->increments('id');
            $table->string('solicitud')->nullable();
            $table->string('solicitud_sc')->nullable();
            $table->string('nis')->nullable();
            $table->string('tipo_servicio')->nullable();
            $table->string('movimiento')->nullable();
            $table->string('pronostico')->nullable();
            $table->string('etapa')->nullable();
            $table->timestamp('fecha_solicitud')->nullable();
            $table->timestamp('fecha_convenida')->nullable();
            $table->timestamp('fecha_entrega')->nullable();
            $table->longText('problema')->nullable();
            $table->longText('comentarios')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seg');
    }
}
