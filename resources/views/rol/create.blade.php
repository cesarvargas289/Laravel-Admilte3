    @extends('admin.layout')

    @section('content-title')
        Crear Rol
    @stop

    @section('content')

        @if(session()->has('info'))
            <h3>{{ session('info') }}</h3>
        @else
            <div class="col-md-6"> 
                <div class="card">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> Ingrese datos del Rol </h3> 
                        </div>    
                        <form method="POST" role="form" action="{{ route('rol.store') }}">
                        <!-- Hace que se puedan enviar los datos del formulario
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                            {!! csrf_field() !!}
                            <div class="card-body">
                                <div class"form-group">
                                    <label for="name">Nombre del rol</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                        {!! $errors->first('name', '<span class=error>:message</span>')  !!}   
                                </div>
                                <div class"form-group">
                                    <label for="description"> Descripción</label>
                                    <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                                        {!! $errors->first('description', '<span class=error>:message</span>')  !!}
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit"> Enviar </button>
                            </div>   
                        </form>
                    </div>        
                </div>
            </div>
        
        @endif
    @stop

