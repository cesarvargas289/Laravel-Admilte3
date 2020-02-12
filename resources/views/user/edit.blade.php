@extends('admin.layout')

@section('content-title')
    <h1>Editar Usuario {{ $user->name }}</h1>
@stop

@section('content')
    @if(session()->has('info'))
        <h3>{{ session('info') }}</h3>
    @else
    <div class="col-md-6"> 
        <div class="card">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"> Modificar usuario </h3> 
                </div>    
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        {!! method_field('PUT') !!}
                        {!! csrf_field() !!}
                        <div class="card-body">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="name"> Nombre </label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name}}">
                                    {!! $errors->first('name', '<span class=error>:message</span>')  !!}
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="email"> Correo </label>
                                <input type="text" class="form-control"  name="email" value="{{ $user->email}}">
                                    {!! $errors->first('email', '<span class=error>:message</span>')  !!}
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="password"> Password </label>
                                <input type="password" class="form-control"  name="password" value="{{ $user->password}}" >
                                    {!! $errors->first('password', '<span class=error>:message</span>')  !!}
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="Rol"> Rol  </label>
                                <select class="form-control" name="rol">
                                    @foreach($roles as $rol)
                                        @foreach($roles_user as $rol_user)
                                        @endforeach
                                        <option value="{{ $rol->id }}"
                                        @if($user->id==$rol_user->user_id) {{ $selectedvalue_rol == $rol->id ? 'selected="selected"' : '' }} @endif >{{ $rol->name}}</option>
                                        {!! $errors->first('id', '<span class=error>:message</span>')  !!}
                                    @endforeach
                                </select>
                            </div>
                                <input class="btn btn-primary" type="submit" value="Enviar">
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
@stop
