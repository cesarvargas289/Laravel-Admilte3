<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seg extends Model
{
	protected $table = 'seg';
    protected $fillable = ['solicitud','solicitud_sc','nis','tipo_servicio','movimiento','pronostico',
     'etapa','fecha_solicitud','hora_solicitud','fecha_convenida','fecha_entrega','problema',
     'comentarios','paro_reloj','motivo_paro_reloj', 'inicio_paro_reloj', 'fin_paro_reloj'];
    public $timestamps = false;

   public function getDateFormat()
{
     return 'Y-m-d H:i:s.u';
}

}
