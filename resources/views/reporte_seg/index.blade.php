 @extends('admin.layout')

    @section('content-title')
    <h1>Reporte SEG</h1>
@stop
@section('content')
<form method="POST" action="{{ route('reporte_seg.post') }}">
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
        <table width="100%" id ="reporte_seg-table">
            <thead>
                <tr>
                    <th>Múmero Cliente</th>
                    <th>Telefono asignado</th>
                    <th>Folio</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>NIS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resultados as $resultado)
                    <tr>
                        <td>{{ $resultado['numero_cliente_dish'] }}</td>
                        <td>{{ $resultado['tel_asig'] }}</td>
                        <td>{{ $resultado['fol_seg'] }}</td>
                        <td>{{ $resultado['nombre_cte'] }}</td>
                        <td>{{ $resultado['app'] }}</td>
                        <td>{{ $resultado['apm'] }}</td>
                        <td>{{ $resultado['nis'] }}</td>
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

 $(function () {
var table =  $(document).ready(function() {
                $('#reporte_seg-table').DataTable({

                    dom: 'Bfrtip',
                    columnDefs: [
                        {
                            targets: 1,
                            className: 'noVis'
                        },
                        {
                            "targets": [ 5, 6, 7, 8, 9, 10, 11 ],
                            "visible": false
                        }
                    ],
                        buttons: [
                            {
                                extend: 'csvHtml5',
                                title: 'Telefonos',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                title: 'Telefonos',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                                }
                            },
                            {
                                extend: 'colvis',
                                columns: ':not(.noVis)'
                            }

                        ],
                    }


                );
            } );


});    


        </script>
@stop