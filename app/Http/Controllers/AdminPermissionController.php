<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AdminPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    	$permisos=Permission::all();
    	return  view('admin.permisos.index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //esto se deben desactivar todas las rutas de abm de permisos
       
    	//return view('admin.permisos.create');
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
       	/**Permission::create([
       			'name' => $request['name'],
       			
       	]);
       	return redirect('/admin/permisos');**/
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
        /*
        Permission::destroy($id);
        return redirect('/admin/permisos');*/
    	return view('admin.permisos.index');
    }
}
