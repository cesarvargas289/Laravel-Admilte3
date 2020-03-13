<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acumulado extends Model
{
    protected $table = 'acumulados';
    protected $fillable = ['numero_suscriptor','estatus_suscriptor','ciclo_facturacion',
    'fecha_ultimo_estatus','capturista','fecha_captura','estado_suscriptor','correo','numero_orden',
    'estado_orden','grupo_funcional','order_type','motivo_creacion','login_creado','canal_venta', 
    'num_seg', 'fecha_vencimiento', 'producto','tipo_producto', 'internet', 'atributo_accion', 
    'fecha_creacion_orden', 'fecha_envio_orden', 'fecha_cierre_orden', 'fecha_cancelacion', 'play'];
    public $timestamps = false;

   public function getDateFormat()
{
     return 'Y-m-d H:i:s.u';
}
}
