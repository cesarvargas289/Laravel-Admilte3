<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objetado extends Model
{
    protected $table = 'objetados';
    protected $fillable = ['folio_seg', 'fecha_solicitud', 'fecha_instalacion', 'estatus_seg',
    					 'fecha_objecion', 'motivo_objecion'];
    public $timestamps = false;

   public function getDateFormat()
{
     return 'Y-m-d H:i:s.u';
}
}
