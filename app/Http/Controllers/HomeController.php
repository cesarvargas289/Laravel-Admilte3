<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Persona;
use App\Departamento;
use App\CentroCosto;
use App\Telefono;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'user']);
        return view('home');
    }

    /*
        public function someAdminStuff(Request $request)
        {
            $request->user()->authorizeRoles(‘admin’);

            return view(‘some.view’);
        }
        */
}
