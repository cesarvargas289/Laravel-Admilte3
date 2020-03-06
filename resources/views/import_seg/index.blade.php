 @extends('admin.layout')

    @section('content-title')
    <h1>Importar archivo SEG</h1>
@stop
@section('content')

  <!-- Message -->
     @if(Session::has('message'))
        <p >{{ Session::get('message') }}</p>
     @endif

<div class="card card"> 
 <form method="POST" enctype="multipart/form-data" action="{{ route('seg.post') }}">
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
 @if (isset($datos_seg))
    <div class="card-body"> 
        <table width="100%" class="table table-striped table-bordered" id ="seg-table">
            <thead>
                <tr>
                    <th>Solicitud</th>
                    <th>Movimiento</th>
                    <th>Etapa</th>
                    <th>Fecha solicitud</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos_seg as $datos)
                    <tr>
                        <td>{{ $datos->solicitud }}</td>
                        <td>{{ $datos->movimiento }}</td>
                        <td>{{ $datos->etapa }}</td>
                        <td>{{ $datos->fecha_solicitud }}</td>
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
        $('#seg-table').DataTable();
        });



 </script>
@stop