<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CeceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       $usuarios = DB::connection('oracle')->select("SELECT * FROM USUARIO"); 
       //dd($usuarios);
         return view('cece.index',['usuarios'=>$usuarios]);

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

        $resultados = $this->Cece($start, $end);
        //dd($resultados);
        return view('cece.index',['resultados'=>$resultados]);
    }

    public function Cece($start, $end){
        $resultados = DB::connection('oracle')->select("SELECT 
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
                                        WHERE CLIENTE.FECHA_ALTA>=TO_DATE('$start','YYYY-MM-DD') AND CLIENTE.FECHA_ALTA<=TO_DATE('$end','YYYY-MM-DD')+1 ORDER BY ID DESC  ");
        return $resultados;
    }

}
