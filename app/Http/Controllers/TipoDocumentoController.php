<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDocumento;

class TipoDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->get('search');
        $busqueda_por= $request->get('busqueda_por');
        if($request){
            switch ($busqueda_por) {
            case 'busqueda_id':
                $tipoDoc=TipoDocumento::where('id','LIKE','%'.$query.'%')
                ->orderBy('id','asc')
                ->get();
                $busqueda_por="ID";
                break;
            case 'busqueda_name':
                $tipoDoc=TipoDocumento::findByName($query)->get();
                $busqueda_por="NOMBRE";
                break;
            default:
                $tipoDoc=TipoDocumento::all();
                break;
            }
        }
        $tipoDoc_total=TipoDocumento::all()->count();
        return  view('admin_personas.tipo_dni.index', compact('tipoDoc','tipoDoc_total','query','busqueda_por'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin_personas.tipo_dni.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $docume=TipoDocumento::create([
            'name' => $data['name']
          ]);

        $docume->save();
        return redirect('/tipoDocumento');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo=TipoDocumento::find($id);
        return view('admin_personas.tipo_dni.show',compact('tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo=TipoDocumento::find($id);
        return view('admin_personas.tipo_dni.edit',compact('tipo'));
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
        $tipo=TipoDocumento::find($id);
        $tipo->name=$request->name;
        $tipo->save();
        return redirect('/tipoDocumento');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tipo=TipoDocumento::find($id);
            $tipo->delete();
            return response()->json([
                'estado'=>'true',
                'success' => 'tipo de documento eliminado con exito!'
            ]);
          } catch (\Exception $e) {
            return response()->json([
              'estado'=>'false',
              'success' => 'No se pudo eliminar el tipo de documento !'
            ]);
          }
    }
}
