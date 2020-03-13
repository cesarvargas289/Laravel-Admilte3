@extends('admin.layout')

    @section('content-title')
    <h1>Importar archivo Objetados</h1>
@stop
@section('content')

  <!-- Message -->
     @if(Session::has('message_success'))
       <p class="alert alert-success">{{ Session::get('message_success') }}</p>
     @endif
     @if(Session::has('message_alert'))
       <p class="alert alert-warning">{{ Session::get('message_alert') }}</p>
     @endif
     

<div class="card card"> 
 <form method="POST" enctype="multipart/form-data" action="{{ route('objetado.post') }}">
            {!! csrf_field() !!}
    <div class="card-header"> 
        <div class="row">
            <div class="col-md-3">
       		   <div class="form-group">
    		      <label for="exampleFormControlFile1">Seleccionar archivo</label>
    			  <input type="file" class="form-control-file" name="file" id="file">
    		   </div> 
            </div>
            <div class="col-md-1">
    			<input class="btn btn-primary" type="submit" data-toggle="modal"data-target="#modal" id="enviar" name="submit" value="Enviar">
            </div>    
    	</div>
    </div>
</form>
 @if (isset($datos_objetado))
    <div class="card-body"> 
        <table width="100%" class="table table-striped table-bordered" id ="objetado-table">
            <thead>
                <tr>
                    <th>Folio Seg</th>
                    <th>Fecha Solicitud</th>
                    <th>Fecha Instalación</th>
                    <th>Estatus Seg</th>
                    <th>Fecha Objeción</th>
                    <th>Motivo Objeción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos_objetado as $datos)
                    <tr>
                        <td>{{ $datos->folio_seg }}</td>
                        <td>{{ $datos->fecha_solicitud }}</td>
                        <td>{{ $datos->fecha_instalacion }}</td>
                        <td>{{ $datos->estatus_seg }}</td>
                        <td>{{ $datos->fecha_objecion }}</td>
                        <td>{{ $datos->motivo_objecion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endif
@stop


 @section('scripts')
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
 
 <script type="text/javascript">
    $(document).ready(function() {
        $('#objetado-table').DataTable();
        });



 </script>
@stop