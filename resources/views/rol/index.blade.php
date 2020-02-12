@extends('admin.layout')

@section('content-title')
    Roles
@stop

@section('content')

        <div class="row">
            <div class="col-lg-12"> 
                <div class="card">
                <table width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Rol</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $rol)
                        <tr>
                            <td>{{ $rol->id }}</td>
                            <td>{{ $rol->name }}</td>
                            <td>{{ $rol->description }}</td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
       </div> 

    @stop