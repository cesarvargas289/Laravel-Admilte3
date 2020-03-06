<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ReporteSegController extends Controller
{

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
         return view('reporte_seg.index');

    }

    public function indexPost(Request $request)
    {
    	$daterange = $request->input('daterange');

        //Se divide la fecha del rango en inicio y fin
        $start = substr($daterange, 0, 10);
        //se cambia el formato de la fecha
        $start =  date("Y-m-d", strtotime($start));
        $end = substr($daterange, 13, 10);
        //Se cambia el formato de la fecha
        $end = date("Y-m-d", strtotime($end));

        $resultados = $this->Reporte_seg($start, $end);
        return view('reporte_seg.index', compact('resultados'));
    }


    public function Reporte_seg($start, $end){
        $this->start = $start;
        $this->end = $end;

        $resultados_seg = $this->get_data_seg($start, $end);
         $resultados_seg = (array)$resultados_seg;
        $folios = [];
        foreach($resultados_seg as $resultado_seg)
        {
            array_push($folios, $resultado_seg->solicitud);  
        }
        //Se obtienen los datos del    
        $datos_cece = $this->get_data_cece($folios);
    
        $resultados = new Collection;
        $datos_completos =[];
        foreach ($resultados_seg as $dato_seg) 
        {
            $dato_seg = (array)$dato_seg;
            foreach ($datos_cece as $dato_cece)
            {
                $dato_cece = (array)$dato_cece;
                if ($dato_seg['solicitud'] == $dato_cece['fol_seg']) 
                {
                    $resultados = array_merge($dato_cece, $dato_seg);
                    array_push($datos_completos, $resultados);
                }
            }
        }        
        return $datos_completos;


    }

    public function get_data_seg($start, $end)
    {

        $resultados = DB::select("SELECT * FROM seg
                                where fecha_solicitud between '".$start."' and '".$end."'
                               ");
        return $resultados;
    }


    public function get_data_cece($folios)
    {
       //$coleccion = new Collection;
        $array = [];
        foreach($folios as $folio) {
             $data_array = DB::connection('oracle')->select("SELECT 
                                            CLIENTE.ID,
                                            CLIENTE.NUMERO_CLIENTE_DISH,
                                            VALIDACION.TEL_ASIG,
                                            VALIDACION.FOL_SEG,
                                            CLIENTE.NOMBRE_CTE,
                                            CLIENTE.APP,
                                            CLIENTE.APM,
                                            VALIDACION.FECHA_ALTA,
                                            VALIDACION.FECHA_ORD,
                                            VALIDACION.HORA_INST,
                                            VALIDACION.VAL_FACT_VEL,
                                            VALIDACION.VEL_ALC,
                                            VALIDACION.MOTIVO_OBJ
                                        FROM SISTEMA 
                                        INNER JOIN VENDEDOR 
                                        ON SISTEMA.ID_CLIENTE=VENDEDOR.ID_CLIENTE 
                                        INNER JOIN CLIENTE 
                                        ON VENDEDOR.ID_CLIENTE=CLIENTE.ID 
                                        INNER JOIN DOMICILIO 
                                        ON CLIENTE.ID=DOMICILIO.ID_CLIENTE 
                                        INNER JOIN VALIDACION 
                                        ON DOMICILIO.ID_CLIENTE=VALIDACION.ID_CLIENTE 
                                        WHERE VALIDACION.FOL_SEG = '$folio'
                                        ");
        

        foreach ($data_array as $data) {
            array_push($array, $data);
        }

        }
      
        return $array;
    }

    
}
