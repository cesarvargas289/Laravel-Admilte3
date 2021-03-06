 @extends('admin.layout')

 @section('header')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap.min.css" />
 
 @stop

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
        <table width="100%" id ="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Número Cliente</th>
                    <th>Telefono asignado</th>
                    <th>Folio</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Fecha Alta</th>
                    <th>Fecha Orden</th>
                    <th>Hora Instalación</th>
                    <th>Val Velocidad</th>
                    <th>Velocidad Alcanzada</th>
                    <th>Motivo Objeción</th>
                    <th>Solicitud SC</th>
                    <th>Nis</th>
                    <th>Tipo de Servicio</th>
                    <th>Movimiento</th>
                    <th>Pronostico</th>
                    <th>Etapa</th>
                    <th>Fecha Solicitud</th>
                    <th>Fecha Convenida</th>
                    <th>Fecha Entrega</th>
                    <th>Problema</th>
                    <th>Comentarios</th>
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
                        <td>{{ $resultado['fecha_alta'] }}</td>
                        <td>{{ $resultado['fecha_ord'] }}</td>
                        <td>{{ $resultado['hora_inst'] }}</td>
                        <td>{{ $resultado['val_fact_vel'] }}</td>
                        <td>{{ $resultado['vel_alc'] }}</td>
                        <td>{{ $resultado['motivo_obj'] }}</td>
                        <td>{{ $resultado['solicitud_sc'] }}</td>
                        <td>{{ $resultado['nis'] }}</td>
                        <td>{{ $resultado['tipo_servicio'] }}</td>
                        <td>{{ $resultado['movimiento'] }}</td>
                        <td>{{ $resultado['pronostico'] }}</td>
                        <td>{{ $resultado['etapa'] }}</td>
                        <td>{{ $resultado['fecha_solicitud'] }}</td>
                        <td>{{ $resultado['fecha_convenida'] }}</td>
                        <td>{{ $resultado['fecha_entrega'] }}</td>
                        <td>{{ $resultado['problema'] }}</td>
                        <td>{{ $resultado['comentarios'] }}</td>
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
 <!-- Scripts de datarange-->


<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

 <!-- Scripts de datatable-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
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
    var table = $('#example').DataTable( {
        lengthChange: false,
        dom: 'Bfrtip',
        columnDefs: [
                        {
                            targets: 1,
                            className: 'noVis'
                        },
                        {
                            "targets": [ 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22 ],
                            "visible": false
                        }
                    ],
                      
        buttons: [ 'copy', 'excel' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );


 (function ($, DataTable) {
                // Datatable global configuration
                $.extend(true, DataTable.defaults, {
                    language: {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": " Primero ",
                            "sLast": " Último",
                            "sNext": "     Siguiente",
                            "sPrevious": "Anterior     "
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
            })(jQuery, jQuery.fn.dataTable);


        </script>
@stop