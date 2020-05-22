<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

	public function index(){
		$user=Auth::user();
		if ($user){
		return view('/user/perfil', compact('user'));
		}return ('auth.login');
	}
	public function config(){
		$user=Auth::user();
		if ($user){
			return view('/user/config', compact('user'));
		}return ('auth.login');
	}
	public function update(UserRequest $request, $id)
	{
		//
		$user=User::find($id);
		$user->name=$request->name;
		$user->save();
		return redirect('/perfil');

	}
	public function store(UserRequest $request)
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
	public function updatePassword(PasswordRequest $request, $id)
	{

		if (Hash::check($request->mypassword,Auth::user()->password)){
			$user=Auth::user();
			$user->password=bcrypt($request->password);
			$user->save();
			return redirect('/perfil');
			}
			return redirect('/config');//mostrar un mensaje de error al actualizar
			//}
	}

}
