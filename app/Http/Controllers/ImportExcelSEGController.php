<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Seg;
use Session;
use Carbon\Carbon;
use DateTime;

class ImportExcelSEGController extends Controller
{
    public function index()
    {
         $datos_seg = Seg::all();
    	return view('import_seg.index', compact('datos_seg'));
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
                            
                          $fecha_solicitud =$this->change_date_format($importData[7]);
                          //dd($fecha_solicitud);
                          $fecha_convenida = $this->change_date_format($importData[8]);
                          $fecha_entrega = $this->change_date_format($importData[9]);
                            Seg::firstOrCreate(
                            ['solicitud'=>$importData[0]],
                            ['solicitud_sc'=>$importData[1],
                            'nis'=>$importData[2],
                            'tipo_servicio'=>$importData[3],
                            'movimiento'=>$importData[4],
                            'pronostico'=>$importData[5],
                            'etapa'=>$importData[6],
                            'fecha_solicitud'=>$fecha_solicitud,
                            'fecha_convenida'=>$fecha_convenida,
                            'fecha_entrega'=>$fecha_entrega,
                            'problema'=>$importData[10],
                            'comentarios'=>$importData[11] ]);             
                    }
                        Session::flash('message','Guardado Correctamente.');
                    }else{
                        Session::flash('message','El archivo es muy grande debe ser menor a 8MB.');
                    }
            }else{
                Session::flash('message','Extensión invalida, el archivo debe ser csv.');
            }
        }
        // Redirect to index
        return redirect()->action('ImportExcelSEGController@index');
    }

    public function change_date_format($date)
    {
       //Se divide la fecha del rango en inicio y fin
        $año = substr($date, 6, 4);
        $mes = substr($date, 3, 2);      
        $dia = substr($date, 6, 2);    
        $hora =substr($date, 10, 6);
        $fecha = $año.'/'.$mes.'/'.$dia.$hora;
        return $fecha;
            
    }
}
