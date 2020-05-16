<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$user=Auth::user();
    	$roles=$user->getRoleNames();
    	$role = null;
    	foreach($roles as $rol){
    		$role=$rol;
    	}
    	$roleName=$role;
    	switch($role){
    		case "Administrador":
    			return view('home',compact('roleName'));//cambie home por prueba
    			break;
    		default: return view('home',compact('roleName'));
    	}

    }
}
