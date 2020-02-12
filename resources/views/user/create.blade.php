    @extends('admin.layout')

    @section('content-title')
        Crear Usuario
    @stop

    @section('content')
    @if(session()->has('info'))
        <h3>{{ session('info') }}</h3>
    @else
    <div class="col-md-6"> 
        <div class="card">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"> Ingrese datos del Usuario </h3> 
                </div>    
                    <form method="POST" role="form" action="{{ route('user.store') }}">
                            {!! csrf_field() !!}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"> Nombre </label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                {!! $errors->first('name', '<span class=error>:message</span>')  !!}
                        </div>
                        <div class="form-group">
                            <label for="email"> Correo </label>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                {!! $errors->first('email', '<span class=error>:message</span>')  !!}
                        </div>
                        <div class="form-group">
                            <label for="password"> Password </label>
                            <input type="password" class="form-control" name="password" >
                                {!! $errors->first('password', '<span class=error>:message</span>')  !!}
                        </div>
                        <div class="form-group">
                            <label for="Rol"> Rol </label>
                            <select class="form-control" name="rol">
                                @foreach($roles as $rol)
                                    <option >{{$rol->name}}</option>
                                        {!! $errors->first('name', '<span class=error>:message</span>')  !!}
                                @endforeach
                             </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input class="btn btn-primary" type="submit" value="Enviar">
                    </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop



