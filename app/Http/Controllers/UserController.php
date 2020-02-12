<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Http\Requests;
use App\User;
use App\Role;
use App\Rol_User;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles('admin');

        $usuarios = User::all();
        $roles = Role::all();
        $rol_de_usuarios = Rol_User::all();

        return view('user.index', compact('usuarios', 'roles', 'rol_de_usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        $usuarios = User::all();
        $roles = Role::all();
        $rol_de_usuarios = Rol_User::all();
        return view('user.create', compact('usuarios', 'roles', 'rol_de_usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles('admin');

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',

        ]);
 
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        $user_id =DB::getPdo()->lastInsertId();
        $rol = Input::get('rol');
        $rol_id = DB::table('roles')->where('name', $rol)->value('id');
        Rol_User::create(['role_id'=>$rol_id, 'user_id'=>$user_id]);
 

        //Redireccionar

        Return redirect()->route('user.index');


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
    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles('admin');

        $user = User::findOrFail($id);
        $roles = Role::all();
        $roles_user = Rol_User::all();
        $selectedvalue_rol = DB::table('role_user')->where('user_id', $id)->value('role_id');

        return view('user.edit', compact('user',  'roles', 'roles_user', 'selectedvalue_rol'));

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

        //Se verifica si el password esta encriptado si lo está, actualiza todo menos el password si no, encripta el password y actualiza
        if( strlen($password) == 60 ){
            User::findOrFail($id)->update($request->except('password'));
        }else{
            User::findOrFail($id)->update($request->all());
            User::findOrFail($id)->update($request->except('password'));
            User::findOrFail($id)->update( ['password' => bcrypt($request['password'])]);
        }
        //Actualizacion de rol al usuario en tabla intermedia
        $rol = Input::get('rol');
        Rol_User::where('user_id', $id)->update(['role_id' => $rol]);

        //Redireccionamos
        return redirect()->route('user.index');
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
        $id = DB::table('role_user')->where('user_id', $id)->value('id');
        //Borra la relación en tabla role_user entre usuario y rol
        Rol_User::findOrFail($id)->delete();
        //Redireccionar
        return redirect()->route('user.index');
    }
}
