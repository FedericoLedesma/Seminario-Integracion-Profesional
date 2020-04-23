<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
	public function cambiarPassword(){
		$user=Auth::user();
		return view('user.changePassword',compact('user'));
	}
	public function updatePassword(Request $request, $id)//Construir un request para el password
	{
		//crear la validacion
	/**	$rules=[
				'mypassword'=>'required',
				'password'=>'required|confirmed|min:8|max:18',
		];
		$messages=[
				'mypassword.required'=>"el campo es requerido",
				'password.required'=>"el campo es requerido",
				'password.confirmed'=>"el campo es requerido",
				'password.min'=>"el campo es requerido",
				'password.max'=>"el campo es requerido",
		
		];
		$validator= Validator::make($request->all(),$rules,$messages);
		if ($validator->fails){
			return view ('user.changePassword')->withErrors($validator);
		}else{**/
		if (Hash::check($request->mypassword,Auth::user()->password)){
			$user=Auth::user();
			$user->password=bcrypt($request->password);
			$user->save();
			}
			//}
	}
}
