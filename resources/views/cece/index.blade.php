 @extends('admin.layout')

@section('content')
 <form method="POST" action="{{ route('cece.post') }}">
            {!! csrf_field() !!}
<div class="card card-default" data-select2-id="42">
    <div class="card-header"> 
        <div class="row">
            <div class="col-md-2">
                <h3 class="card-title"> Seleccionar fecha </h3>    
            </div>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div> 
                    <input id="daterange" name="daterange" class="form-control float-right" type="text">
                    <input class="btn btn-primary" type="submit" id="enviar" name="enviar" value="Enviar">
       
                </div>    
            </div>
    </div>
    </div>
     @if (isset($resultados))
    <div class="card-body"  data-select2-id="41"> 
        <table width="100%" id ="cece-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>número Cliente</th>
                    <th>Teléfono asignado</th>
                    <th>Folio</th>
                    <th>Nombre</th>
                    <th>Fecha Alta</th>
                    <th>Fecha/hora Instalción</th>
                    <th>Velocidad Contratada</th>
                    <th>Velocidad Alcanzada</th>
                    <th>Motivo Objeción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resultados as $resultado)
                    <tr>
                        <td>{{ $resultado->numero_cliente_dish }}</td>
                        <td>{{ $resultado->tel_asig }}</td>
                        <td>{{ $resultado->fol_seg }}</td>
                        <td>{{ $resultado->nombre_cte }} {{ $resultado->app }} {{ $resultado->apm }}</td>
                        <td>{{ $resultado->fecha_alta }} </td>
                        <td>{{ $resultado->fecha_ord }} {{ $resultado->hora_inst }}</td>
                        <td>{{ $resultado->val_fact_vel }}</td>
                        <td>{{ $resultado->vel_alc }}</td>
                        <td>{{ $resultado->motivo_obj }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

</form>

@stop

 @section('scripts')
 <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
 
       <script type="text/javascript">
            $(function() {
                $('input[name="daterange"]').daterangepicker({
                    opens: 'left'
                }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });
            });
            $(function () {
                $('#daterange').daterangepicker({
                    "locale": {
                        "format": "YYYY-MM-DD",
                        "separator": " - ",
                        "applyLabel": "Guardar",
                        "cancelLabel": "Cancelar",
                        "fromLabel": "Desde",
                        "toLabel": "Hasta",
                        "customRangeLabel": "Personalizar",
                        "daysOfWeek": [
                            "Do",
                            "Lu",
                            "Ma",
                            "Mi",
                            "Ju",
                            "Vi",
                            "Sa"
                        ],
                        "monthNames": [
                            "Enero",
                            "Febrero",
                            "Marzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Setiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre"
                        ],
                        "firstDay": 1
                    },
                "startDate": new Date(),
                "endDate": new Date(),
        "opens": "center"
    });
});

 $(document).ready(function() {
        $('#cece-table').DataTable();
        });




        </script>
@stop
