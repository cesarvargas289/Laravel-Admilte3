<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Acumulado;
use Session;
use Carbon\Carbon;
use DateTime;

class ImportExcelAcumuladoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function index()
    {
        //Muestra los últimos 2 meses de 
         $datos_acumulado = Acumulado::where("fecha_captura",">", Carbon::now()->subMonths(2))->get();
    	return view('import_acumulado.index', compact('datos_acumulado'));
    }

    public function import(Request $request)
    {
        if ($request->input('submit') != null ){
            $file = $request->file('file');
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");
            // 8MB in Bytes
            $maxFileSize = 8097152; 
            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){
                // Check file size
                if($fileSize <= $maxFileSize){
                    // File upload location
                    $location = 'uploads';
                    // Upload file
                    $file->move($location,$filename);
                    // Import CSV to Database
                    $filepath = public_path($location."/".$filename);
                    // Reading file
                    $file = fopen($filepath,"r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata );
                        // Skip first row (Remove below comment if you want to skip the first row)
                        /*if($i == 0){
                        $i++;
                        continue; 
                        }*/
                        for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);
                    // Insert to MySQL database
                    foreach($importData_arr as $importData){
                         //dd($importData);
                            
                          $fecha_ultimo_estatus =$this->change_date_format($importData[3]);
                          //dd($fecha_solicitud);
                          $fecha_captura = $this->change_date_format($importData[5]);
                          $fecha_vencimiento = $this->change_date_format($importData[16]);
                          $fecha_creacion_orden = $this->change_date_format($importData[21]);
                          $fecha_envio_orden = $this->change_date_format($importData[22]);
                          $fecha_cierre_orden = $this->change_date_format($importData[23]);
                          $fecha_cancelacion = $this->change_date_format($importData[24]);
                            Acumulado::updateOrCreate(
                            ['numero_suscriptor'=>utf8_encode($importData[0])],
                            ['estatus_suscriptor'=>utf8_encode($importData[1]),
                            'ciclo_facturacion'=>utf8_encode($importData[2]),
                            'fecha_ultimo_estatus'=>utf8_encode($fecha_ultimo_estatus),
                            'capturista'=>utf8_encode($importData[4]),
                            'fecha_captura'=>utf8_encode($fecha_captura),
                            'estado_suscriptor'=>utf8_encode($importData[6]),
                            'correo'=>utf8_encode($importData[7]),
                            'numero_orden'=>utf8_encode($importData[8]),
                            'estado_orden'=>utf8_encode($importData[9]),
                            'grupo_funcional'=>utf8_encode($importData[10]),
                            'order_type'=>utf8_encode($importData[11]),
                            'motivo_creacion'=>utf8_encode($importData[12]),
                            'login_creado'=>utf8_encode($importData[13]),
                            'canal_venta'=>utf8_encode($importData[14]),
                            'num_seg'=>utf8_encode($importData[15]),
                            'fecha_vencimiento'=>utf8_encode($fecha_vencimiento),
                            'producto'=>utf8_encode($importData[17]),
                            'tipo_producto'=>utf8_encode($importData[18]),
                            'internet'=>utf8_encode($importData[19]),
                            'atributo_accion'=>utf8_encode($importData[20]),
                            'fecha_creacion_orden'=>utf8_encode($fecha_creacion_orden),
                            'fecha_envio_orden'=>utf8_encode($fecha_envio_orden),
                            'fecha_cierre_orden'=>utf8_encode($fecha_cierre_orden),
                            'fecha_cancelacion'=>utf8_encode($fecha_cancelacion),
                            'play'=>utf8_encode($importData[25]) ]);             
                    }
                        Session::flash('message_success','Guardado Correctamente.');
                    }else{
                        Session::flash('message_alert','El archivo es muy grande debe ser menor a 8MB.');
                    }
            }else{
                Session::flash('message_alert','Extensión invalida, el archivo debe ser csv.');
            }
        }
        // Redirect to index
        return redirect()->action('ImportExcelAcumuladoController@index');
    }

    public function change_date_format($date)
    {
       //Se divide la fecha del rango en inicio y fin
    	//dd($date);
        $año = substr($date, 6, 4);
        $mes = substr($date, 3, 2);      
        $dia = substr($date, 0, 2);    
        $fecha = $año.'/'.$mes.'/'.$dia;
        return $fecha;
            
    }
}
