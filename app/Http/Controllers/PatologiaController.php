<?php

namespace App\Http\Controllers;

use App\Patologia;
use App\Dieta;
use App\Alimento;
use DateTime;
use App\DietaActiva;
use App\TipoPatologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PatologiaRequest;

class PatologiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
       $this->middleware(['permission:alta_patologias'],['only'=>['create','store']]);
       $this->middleware(['permission:baja_patologias'],['only'=>['destroy']]);
       $this->middleware(['permission:modificacion_patologias'],['only'=>['edit']]);
       $this->middleware(['permission:ver_patologias'],['only'=>['index']]);
        $this->middleware('auth');
     }
    public function index(Request $request)
    {
      $query = $request->get('search');
      $busqueda_por= $request->get('busqueda_por');
      if($request){
        switch ($busqueda_por) {
          case 'busqueda_id':
            $patologias=Patologia::where('id','LIKE','%'.$query.'%')
              ->orderBy('id','asc')
              ->get();
            $busqueda_por="ID";
            break;
          case 'busqueda_name':
              $patologias=Patologia::findByName(strtoupper($query))->get();
              $busqueda_por="NOMBRE";
            break;
            case 'busqueda_tipo_patologia':
                $patologias=Patologia::findByTipoPatologia(strtoupper($query))->get();
                $busqueda_por="TIPO DE PATOLOGIA";
              break;
          default:
            $patologias=Patologia::all();
            break;
        }

      }
    //	$users=User::all();
      $patologias_total=Patologia::all()->count();
      return  view('admin_patologias.patologias.index', compact('patologias','patologias_total','query','busqueda_por'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $tipos_patologias=TipoPatologia::all();
          return view('admin_patologias.patologias.create',compact('tipos_patologias'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatologiaRequest $request)
    {
        $data=$request->all();
        $patologia=Patologia::create([
            'name' => strtoupper($data['name']),
            'descripcion'=>$data['descripcion'],

          ]);

        $patologia->save();
        $user=Auth::user();
        $dieta=Dieta::create([
          'patologia_id'=>$patologia->id,
          'observacion'=>$patologia->name,
          'personal_id'=>$user->personal_id,
        ]);
        $fecha= new DateTime(date("Y-m-d H:i:s"));
        $dieta_activa=new DietaActiva();
        $dieta_activa->dieta_id=$dieta->id;
        $dieta_activa->fecha=$fecha;
        $dieta_activa->observacion=$dieta->observacion;
      /*  $dietaActiva=DietaActiva::create([
          'dieta_id'=>$dieta->id,
          'fecha'=>$fecha,
          'observacion'=>$dieta->observacion,
        ]);*/
        $dieta_activa->save();
        return redirect('/patologias');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patologia  $patologia
     * @return \Illuminate\Http\Response
     */
    public function show(Patologia $patologia)
    {
        return  view('admin_patologias.patologias.show', compact('patologia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patologia  $patologia
     * @return \Illuminate\Http\Response
     */
    public function edit(Patologia $patologia)
    {
      $tipos_patologias=TipoPatologia::all();
          return view('admin_patologias.patologias.edit',compact('patologia','tipos_patologias'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patologia  $patologia
     * @return \Illuminate\Http\Response
     */
    public function update(PatologiaRequest $request, Patologia $patologia)
    {
        if($patologia){
          $patologia->name=strtoupper($request->name);
          $patologia->tipo_patologia_id=$request->tipo_patologia_id;
          $patologia->save();
          $fecha= new DateTime(date("Y-m-d"));
          try{
            $dieta=Dieta::findByPatologia($patologia->id);
            if($dieta){
              $dietaActiva=DietaActiva::findById($dieta->id);
              $dietaActiva->fecha_final=$fecha;
              $dietaActiva->guardar();
              $f= new DateTime(date("Y-m-d H:i:s"));
              $da=DietaActiva::create([
                'dieta_id'=>$dieta->id,
                'fecha'=>$f,
                'observacion'=>$dieta->observacion,
              ]);
              /**
              Luego de crear una dieta activa se debe generar las raciones
              disponibles para dicha dieta.
              **/
              Log::info($da);
            }
          }catch(\Exception $e) {
            return redirect('/patologias');
          }

        }
        return redirect('/patologias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patologia  $patologia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patologia $patologia)
    {
      try {
      $patologia->delete();
      return response()->json([
          'estado'=>'true',
          'success' => 'Patologia eliminada con exito!'
      ]);
      }catch (\Exception $e) {
        return response()->json([
          'estado'=>'false',
          'success' => 'No se puede eliminar esta patologia !'
        ]);
      }
    }
    public function agregarAlimentosProhibidos($id){
      $patologia=Patologia::findById($id);
      return view('admin_patologias.patologias.agregar-alimentos',compact('patologia'));
    }
    public function guardarAlimentos(Request $request){
      Log::info($request->data[0]);
      $id=$request->data[0];
      $patologia=Patologia::findById($id);
      Log::info($patologia);
      $idAlimentos=$request->data[1];
      Log::info($idAlimentos);
      $fecha= new DateTime(date("Y-m-d"));
      foreach ($idAlimentos as $idAlimento) {
        $alimento=Alimento::findById($idAlimento);
        Log::info($alimento);
        try{
        $patologia->alimentos()->attach($alimento,['fecha'=>$fecha]);
        }catch (\Exception $e) {}
      }
      $als=array();
      $alimentos=$patologia->alimentos;
      Log::info($alimentos);
      return response([
        'alimentos'=>$alimentos->toArray(),
      ]);
    }

    public function quitarAlimento(Request $request){
      Log::debug("Quitar Alimento de patologias");
      Log::info($request);
      $idPatologia=$request->data[0];
      $idAlimento=$request->data[1];
      $patologia=Patologia::findById($idPatologia);
      Log::info($patologia);
      $patologia->alimentos()->detach($idAlimento);
      return response()->json([
          'estado'=>'true',
          'success' => 'Alimento quitado con exito!'
      ]);
    }
}
