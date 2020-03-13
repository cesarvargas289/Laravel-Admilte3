 @extends('admin.layout')

    @section('content-title')
    <h1>Usuarios</h1>
    <a href="{{route('user.create')}}" class="btn btn-info">Crear</a>
@stop

@section('content')
    <table width="100%" class="table table-striped table-bordered" id ="usuarios-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>rol</th>
            <th>Acciones</th>

        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                @foreach($rol_de_usuarios as $rol_de_usuario)
                    @foreach($roles as $rol)
                        @if($usuario->id == $rol_de_usuario->user_id)
                            @if($rol_de_usuario->role_id == $rol->id)
                                <td> {{ $rol->name }} </td>
                            @endif
                        @endif
                    @endforeach
                @endforeach

                <td>
                    <a class="btn btn-warning" href="{{ route('user.edit', $usuario->id) }}">Editar</a>
                    <form style="display: inline" onsubmit="return confirm('Estás seguro que quieres eliminar?');" action="{{ route('user.destroy', $usuario->id) }}" method="POST" >
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE" />
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>

                </td>
            </tr>
        @endforeach


        </tbody>
    </table>
@stop

 @section('scripts')
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
 
 <script type="text/javascript">
    $(document).ready(function() {
        $('#usuarios-table').DataTable();
        });



 </script>
@stop