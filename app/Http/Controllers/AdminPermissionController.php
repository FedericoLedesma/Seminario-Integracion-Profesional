<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class AdminPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
   	{
   		 $this->middleware('auth');
   	}

    public function index(Request $request)
    {
        //
        $query = $request->get('search');
  			$busqueda_por= $request->get('busqueda_por');
        if($request){
  				switch ($busqueda_por) {
  					case 'busqueda_id':
  						$permisos=Permission::where('id','LIKE','%'.$query.'%')
  						->orderBy('id','asc')
  						->get();
  							$busqueda_por="ID";
  						break;
  					case 'busqueda_name':
  						$permisos=Permission::where('name','LIKE','%'.$query.'%')
  						->orderBy('id','asc')
  						->get();
  						break;
  						$busqueda_por="NOMBRE";

  					default:
  						$permisos=Permission::all();
  						break;
  				}
        }
        	return  view('admin.permisos.index', compact('permisos','query','busqueda_por'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //esto se deben desactivar todas las rutas de abm de permisos
        $user=Auth::user();
        $acciones=['alta','baja','modificacion','ver'];
        $tablas=['usuarios','roles','permisos'];
        if ($user->can('alta_permisos')){
    	     return view('admin.permisos.create',compact('acciones','tablas'));
         }
    	//return view('admin.permisos.index');
    	return redirect('/admin/permisos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//crear Request para validar los datos recibidos
    {
        //
        $name=$request['name_accion']."_".$request['name_table'];
        $permisos=Permission::where('name','LIKE',$name)
        ->orderBy('id','asc')
        ->get();
        if(count($permisos)==0){
         	Permission::create([
         			'name' => $name,
         	]);
      }

    	return redirect('/admin/permisos');
    	//return view('admin.permisos.index');
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
    	return redirect('/admin/permisos');
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
        /**
    	$permission=Permission::find($id);
    	return view('admin.permisos.edit',compact('permission'));
    	**/
    	return redirect('/admin/permisos');
    	//return view('admin.permisos.index');
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
        /*
    	$permission=Permission::find($id);
    	$permission->name=$request['name'];
    	$permission->save();*/

    	//return view('admin.permisos.index');
    	return redirect('/admin/permisos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user=Auth::user();
        if ($user->can('baja_permisos')){
          Permission::destroy($id);
          return response()->json([
              'estado'=>'true',
              'success' => 'Permiso eliminado con exito!'
          ]);
        }return response()->json([
						'estado'=>'false',
	    			'success' => 'No tiene permiso para eliminar Permiso'
	    	]);
        //return redirect('/admin/permisos');
    }
}
