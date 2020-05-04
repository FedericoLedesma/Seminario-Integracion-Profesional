<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AdminRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct()
	{
		$this->middleware(['permission:alta_roles'],['only'=>['index','create','store','show']]);
		$this->middleware(['permission:baja_roles'],['only'=>['index','destroy']]);
		$this->middleware(['permission:modificacion_roles'],['only'=>['index','edit','update','show']]);
		$this->middleware(['permission:asignar_permisos_roles'],['only'=>['index','edit','update','show']]);
		$this->middleware(['permission:quitar_permisos_roles'],['only'=>['index','edit','update','show']]);
	}
    public function index(Request $request)
    {
        /** debo mostrar todos los roles
        primero tengo que preguntar que haya un usuario conectado
        armar las vistas para los roles

        construir pruebas


        **/
				$query = $request->get('search');
				$busqueda_por= $request->get('busqueda_por');
				if($request){
					switch ($busqueda_por) {
						case 'busqueda_id':
							$roles=Role::where('id','LIKE','%'.$query.'%')
							->orderBy('id','asc')
							->get();
								$busqueda_por="ID";
							break;
						case 'busqueda_name':
								$roles=Role::where('name','LIKE','%'.$query.'%')
								->orderBy('id','asc')
								->get();
									$busqueda_por="NOMBRE";
							break;
						default:
						$roles=Role::all();
						$query=null;
							break;
					}

				}
  		$roles_total=Role::all()->count();
    	return  view('admin.roles.index', compact('roles','roles_total','query','busqueda_por'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    	return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    	Role::create([
    			'name' => $request['name'],

    	]);
    	return redirect('/admin/roles');
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

    	$role=Role::find($id);
    	$permisos = $role->getPermissionNames();
    	return  view('admin.roles.showrole', compact('role','permisos'));
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
        $permisos=Permission::all();

    	$role=Role::find($id);
    	$permisosAsociados=$role->getAllPermissions();

    	//   Realizo lo siguiente para quitar de la lista los permisos que el rol ya dispone
    	$i=0;
    	foreach ($permisos as $per){

    		foreach ($permisosAsociados as $perAs){

	    			if($per->id== $perAs->id){

	    				unset($permisos[$i]);
	    			}
    		}
    		$i++;
    	}


    	return view('admin.roles.edit',compact('role','permisos','permisosAsociados'));
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
        //
    	if(!($id=='1')){
	    	$quitarPermisos=$request['quitarPermisos'];
	    	$agregarPermisos=$request['agregarPermisos'];

	    	$role=Role::find($id);
	    	$role->name=$request['name'];

	    	if(!empty($quitarPermisos)){
	    		foreach ($quitarPermisos as $permission){

	    			$role->revokePermissionTo($permission);

	    		}
	    	}
	    	if(!empty($agregarPermisos)){
		    	foreach ($agregarPermisos as $permiso){
		    		$role->givePermissionTo($permiso);
		    	}
	    	}
	    	$role->save();
    	}
    	return redirect('/admin/roles');
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
				$role=Role::find($id);
				Role::destroy($id);
			}
			return response()->json([
					'success' => 'Rol eliminado con exito!'
			]);
			//return redirect('/admin/users');
		}
}
