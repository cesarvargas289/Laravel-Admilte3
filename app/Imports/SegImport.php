<?php

namespace App\Imports;

use App\Seg;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon;

class SegImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Seg([
            'solicitud'         => $row[0],
            'solicitud_sc'      => $row[1],
            'nis'               => $row[2],
            'tipo_servicio'     => $row[3],
            'movimiento'        => $row[4],
            'pronostico'        => $row[5],
            'etapa'             => $row[6],
            'fecha_solicitud'   => Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7])),
            'fecha_convenida'   => Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8])),
            'fecha_entrega'     => Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9])),
            'problema'          => $row[10],
            'comentarios'       => $row[11],
        ]);
    }
}
