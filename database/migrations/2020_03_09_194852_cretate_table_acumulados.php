<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CretateTableAcumulados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('acumulados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_suscriptor')->nullable();
            $table->string('estatus_suscriptor')->nullable();
            $table->string('ciclo_facturacion')->nullable();
            $table->date('fecha_ultimo_estatus')->nullable();
            $table->string('capturista')->nullable();
            $table->date('fecha_captura')->nullable();
            $table->string('estado_suscriptor')->nullable();
            $table->string('correo')->nullable();
            $table->string('numero_orden')->nullable();
            $table->string('estado_orden')->nullable();
            $table->string('grupo_funcional')->nullable();
            $table->string('order_type')->nullable();
            $table->string('motivo_creacion')->nullable();
            $table->string('login_creado')->nullable();
            $table->string('canal_venta')->nullable();
            $table->string('num_seg')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('producto')->nullable();
            $table->string('tipo_producto')->nullable();
            $table->string('internet')->nullable();
            $table->string('atributo_accion')->nullable();
            $table->date('fecha_creacion_orden')->nullable();
            $table->date('fecha_envio_orden')->nullable();
            $table->date('fecha_cierre_orden')->nullable();
            $table->date('fecha_cancelacion')->nullable();
            $table->string('play')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acumulados');
    }
}
