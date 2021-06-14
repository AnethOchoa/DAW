<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ClientesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->level  !== "administrador"){return redirect('/admin');}
        $datos=\DB::table('clients')
        ->select('clients.*','users.id as idUser', 'users.email', 'users.name')
        ->orderBy('clients.id','DESC')
        ->join('users','clients.id_user','=','users.id')
       /* $datos2=\DB::table('users')
        ->select('users.*')
        ->where('id','=',$datos[0]->id_user)
        ->orderBy('id','DESC')
        ->get();*/
        ->get();
        
        return view('admin.clientes')->with('datos',$datos);
    }
}
