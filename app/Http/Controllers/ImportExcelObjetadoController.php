<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Objetado;
use Session;
use Carbon\Carbon;
use DateTime;

class ImportExcelObjetadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
         $datos_objetado = Objetado::where("fecha_solicitud",">", Carbon::now()->subMonths(2))->get();
    	return view('import_objetado.index', compact('datos_objetado'));
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
                            
                          $fecha_solicitud =$this->change_date_format($importData[1]);
                          //dd($fecha_solicitud);
                          $fecha_instalacion = $this->change_date_format($importData[2]);
                          $fecha_objecion = $this->change_date_format($importData[4]);
                            Objetado::updateOrCreate(
                            ['folio_seg'=>utf8_encode($importData[0])],
                            ['fecha_solicitud'=>utf8_encode($fecha_solicitud),
                            'fecha_instalacion'=>utf8_encode($fecha_instalacion),
                            'estatus_seg'=>utf8_encode($importData[3]),
                            'fecha_objecion'=>utf8_encode($fecha_objecion),
                            'motivo_objecion'=>utf8_encode($importData[5]) ]);             
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
        return redirect()->action('ImportExcelObjetadoController@index');
    }

    public function change_date_format($date)
    {
       //Se divide la fecha del rango en inicio y fin
        $año = substr($date, 6, 4);
        $mes = substr($date, 3, 2);      
        $dia = substr($date, 0, 2);    
        
        $fecha = $año.'/'.$mes.'/'.$dia;
        return $fecha;
            
    }
}
