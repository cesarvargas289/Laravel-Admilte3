@extends('admin.layout')

    @section('content-title')
    <h1>Importar archivo Acumulado</h1>
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
 <form method="POST" enctype="multipart/form-data" action="{{ route('acumulado.post') }}">
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
 @if (isset($datos_acumulado))
    <div class="card-body"> 
        <table width="100%" class="table table-striped table-bordered" id ="acumulado-table">
            <thead>
                <tr>
                    <th>Número suscriptor</th>
                    <th>Estatus Suscriptor</th>
                    <th>Ciclofacturación</th>
                    <th>Fecha Captura</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos_acumulado as $datos)
                    <tr>
                        <td>{{ $datos->numero_suscriptor }}</td>
                        <td>{{ $datos->estatus_suscriptor }}</td>
                        <td>{{ $datos->ciclo_facturacion }}</td>
                        <td>{{ $datos->fecha_captura }}</td>
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
        $('#acumulado-table').DataTable();
        });



 </script>
@stop