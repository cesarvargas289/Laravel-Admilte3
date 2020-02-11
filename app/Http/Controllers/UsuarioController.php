<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Http\Requests;
use App\Usuario;
use App\EstadoEntidad;
use App\Plataforma;
use App\TipoUsuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        $estadoentidades = EstadoEntidad::all();
        $plataformas = Plataforma::all();
        $tipousuarios = TipoUsuario::all();

        return view('usuario.index', compact('usuarios', 'estadoentidades', 'plataformas', 'tipousuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = Usuario::all();
        $estadoentidades = EstadoEntidad::all();
        $plataformas = Plataforma::all();
        $tipousuarios = TipoUsuario::all();

        return view('usuario.create', compact('usuarios', 'estadoentidades', 'plataformas', 'tipousuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'idtipousuario' => 'required',
            'idplataforma' => 'required',
            'idestadoentidad' => 'required',
        ]);


        Usuario::create($request->all());

        //Redireccionar

        Return redirect()->route('usuario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $estadoentidades = EstadoEntidad::all();
        $plataformas = Plataforma::all();
        $tipousuarios = TipoUsuario::all();
        return view('usuario.edit', compact('usuario', 'estadoentidades','plataformas','tipousuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $password = Input::get('password');

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);



        //Redireccionamos
        return redirect()->route('usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles('admin');
        User::findOrFail($id)->delete();
        $id_role = DB::table('role_user')->where('user_id', $id)->value('id');
        //Borra la relación en tabla role_user entre usuario y rol
        Rol_User::findOrFail($id_role)->delete();
        
        //Redireccionar
        return redirect()->route('usuario.index');
    }
}
