<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
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
	//	$this->middleware(['permission:alta_usuarios'],['only'=>['index','create','store','show']]);
	//	$this->middleware(['permission:baja_usuarios'],['only'=>['index','destroy']]);
		//$this->middleware(['permission:modificacion_usuarios'],['only'=>['index','edit','update','show']]);
		//$this->middleware(['permission:asignar_roles_usuarios'],['only'=>['index','edit','update','show']]);
		//$this->middleware(['permission:quitar_roles_usuarios'],['only'=>['index','edit','update','show']]);
		//	$this->middleware(['permission:ejemplo'],['only'=>['index','edit','update','show']]);
		 $this->middleware('auth');
	}
    public function index(Request $request)
    {
    	$query = $request->get('search');
			$busqueda_por= $request->get('busqueda_por');
			if($request){
				switch ($busqueda_por) {
					case 'busqueda_id':
						$users=User::where('id','LIKE','%'.$query.'%')
						->orderBy('id','asc')
						->get();
							$busqueda_por="ID";
						break;
					case 'busqueda_dni':
						$users=User::where('dni','LIKE','%'.$query.'%')
						->orderBy('id','asc')
						->get();
						break;
						$busqueda_por="DNI";
					case 'busqueda_name':
							$users=User::where('name','LIKE','%'.$query.'%')
							->orderBy('id','asc')
							->get();
								$busqueda_por="NOMBRE";
						break;
					default:
						$users=User::all();
						break;
				}

			}
    //	$users=User::all();
    	$users_total=User::all()->count();
    	return  view('admin.users.index', compact('users','users_total','query','busqueda_por'));//view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
				$user=Auth::user();
				if ($user->can('alta_usuarios')){
        $roles=Role::all();
    	return view('admin.users.create',compact('roles'));
		}return redirect('/admin/users');
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
			$user=Auth::user();
			if ($user->can('modificacion_usuarios')){
	    	$user=User::find($id);
				$roles_user=$user->getRoleNames();
				$rol;
				foreach ($roles_user as $role_user) {
					$rol=$role_user;
				}
	    	$roles=Role::all();
	    	return view('admin.users.edit',compact('user','roles','rol'));
			}return redirect('/admin/users');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
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
			$user=Auth::user();
			if ($user->can('baja_usuarios')){
	    	if(!($id=='1')){
	    		$user=User::find($id);
	    		User::destroy($id);
	    	}
				return response()->json([
						'estado'=>'true',
						'success' => 'Usuario eliminado con exito!'
				]);
			}
	    	return response()->json([
						'estado'=>'false',
	    			'success' => 'No tiene permiso para eliminar usuario'
	    	]);

    	//return redirect('/admin/users');
		}
		public function buscar(Request $request){

		/*	switch ($busqueda_por) {
				case 'busqueda_id':
					$users=array();
					$users[]=User::find($id);
					break;
				case 'busqueda_dni':
					$users=array();
					$users[]=User::where('dni', $id)->first();
					break;
				case 'busqueda_dni':
					$users=User::where('name', $id)->get();
					break;
				default:$users=array();
					break;
			}*/
			//return response()->json_encode($users);
			return response()->json([
					'success' => 'funciona!'
			]);
		}
}
