<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\User;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct()
	{
		$this->middleware(['permission:alta_usuarios'],['only'=>['index','create','store','show']]);
		$this->middleware(['permission:baja_usuarios'],['only'=>['index','destroy']]);
		$this->middleware(['permission:modificacion_usuarios'],['only'=>['index','edit','update','show']]);
		$this->middleware(['permission:asignar_roles_usuarios'],['only'=>['index','edit','update','show']]);
		$this->middleware(['permission:quitar_roles_usuarios'],['only'=>['index','edit','update','show']]);
	}
    public function index()
    {
        //
    	$users=User::all();
    	//$roles->getRoleNames();
    	return  view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles=Role::all();
    	return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)//construir un Userrequest para validar la entrada de datos 
    {
        
    	$data=$request->all();
    	$user=User::create([
    			'dni'=>$data['dni'],
    			'name' => $data['name'],
    			'password' => bcrypt($data['dni'])
    	]);    	
    	$roles=$user->getRoleNames();
    	foreach ($roles as $roleName){
    		$user->removeRole($roleName);
    	}    	
    	$role=Role::find($data['role_id']);
    	$user->assignRole($role->name);
    	$user->save();
    	return redirect('/admin/users');
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
    	$user=User::find($id);
    	return  view('admin.users.showuser', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    	$user=User::find($id);
    	$roles=Role::all();
    	return view('admin.users.edit',compact('user','roles'));
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
        if(!($id=='1')){
        	$user=User::find($id);
        	$user->name=$request->name;
        	 
        	$roles=$user->getRoleNames();
        	foreach ($roles as $roleName){
        		$user->removeRole($roleName);
        	}
        	 
        	$role=Role::find($request['role_id']);
        	$user->assignRole($role->name);
        	$user->save();
        	
        }
        return redirect('/admin/users');
    }	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	if(!($id=='1')){
    		User::destroy($id);
    	}
       return redirect('/admin/users');;
    }
}
