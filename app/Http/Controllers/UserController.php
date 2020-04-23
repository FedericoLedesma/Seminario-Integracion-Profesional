<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    
	public function index(){
		$user=Auth::user();
		if ($user){
		return view('/user/perfil', compact('user'));//construir una vista para el perfil
		}return ('auth.login');
	}
	public function config(){
		$user=Auth::user();
		if ($user){
			return view('/user/config', compact('user'));//construir una vista para modificar la contraseña del perfil
		}return ('auth.login');
	}
	public function update(Request $request, $id)
	{
		//
		$user=User::find($id);
		$user->name=$request->name;
		//$user->role_id=$request->role_id;
	
		$user->save();
		return redirect('/perfil');
		 
	}
	public function store(Request $request)
	{
	
		$data=$request->all();
		User::create([
				'dni'=>$data['dni'],
				'name' => $data['name'],
				'password' => bcrypt($data['password'])
		]);
		return redirect('/admin/users');
	}
}
