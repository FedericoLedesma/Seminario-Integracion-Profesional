<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;
use App\Horario;
use App\Paciente;
use App\Persona;
use App\Racion;
use App\Sector;
use App\Habitacion;
use App\RacionesDisponibles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class MenuPersona_enhanced_Controller extends Controller
{
    //
    const path = 'test.improvement.menu_persona';
    public function __construct()
    {
        $this->middleware(['permission:alta_menu'],['only'=>['create','store']]);
        $this->middleware(['permission:baja_menu'],['only'=>['destroy']]);
        $this->middleware(['permission:modificacion_menu'],['only'=>['edit']]);
        $this->middleware(['permission:ver_menu'],['only'=>['index']]);
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        #if (Auth::user()->can('ver_menu_persona')){
          #$menus = MenuPersona::buscar_por_fecha(Carbon::now()->toDateString());
          $menus = MenuPersona::all();
          Log::debug("Se buscaron las planillas del dia: ".Carbon::now()->toDateString());
          foreach ($menus as $m) {
            Log::debug($m);
          }
          return view(self::path.'.index',compact('menus'));
        #}

        return redirect('/home');
    }


        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create(Request $request)
        {
            //
            Log::debug($request);
            Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
            $sector = Sector::all();
            $fecha = Carbon::now()->toDateString();
            $horarios = Horario::all();

            return view(self::path.'.create',compact('sector','fecha','horarios'));
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
            Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
            Log::debug('Se quiere ingresar un nuevo menu persona: '.$request);
            $this->validate($request,[
                'persona'=>'required',
                'horario_id'=>'required',
                'racion'=>'required'
            ]);
            $persona_id = $request->get('persona');
            $horario_id = $request->get('horario_id');
            $racion_id = $request->get('racion');
            $fecha = Carbon::now()->toDateString();
            $user = Auth::user();
            $racion_disponible = RacionesDisponibles::buscar_por_racion_horario_fecha($racion_id, $horario_id, $fecha);
            Log::debug('$persona_id: '.$persona_id);
            Log::debug('$horario_id: '.$horario_id);
            Log::debug('$racion_id: '.$racion_id);
            Log::debug('$fecha: '.$fecha);
            $data = [
              'persona_id'=>$persona_id,
              'racion_disponible_id'=>$racion_disponible->get_id(),
              'fecha'=>$fecha,
              'personal_id'=>$user->id,
              'realizado'=>false,
            ];
            $mp = new MenuPersona($data);
            $mp->save();
            return $this->index($request);
            /*return redirect()->route('/improvement/menu_persona')
                ->with('success','Menu persona registrado satisfactoriamente');*/
        }

        /**
         * Display the specified resource.
         *
         * @param  App\MenuPersona $mp
         * @return \Illuminate\Http\Response
         */
        public function show($id_persona,$id_horario,$fecha)
        {
            //
            $mp = MenuPersona::findById($id_horario,$id_persona,$fecha);
            return  view(self::path.'.show', compact('mp'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($compuesta)
        {
            //
            $horario_id = $compuesta['horario_id'];
            $persona_id = $compuesta['persona_id'];
            $fecha = $compuesta['fecha'];
            $menuPersona = MenuPersona::find($horario_id,$persona_id,$fecha);
            return view(self::path.'.edit',compact('menuPersona'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $compuesta)
        {
            //
            $this->validate($request,[
                'persona_id'=>'required',
                'horario_id'=>'required',
                'racion_id'=>'required',
                'fecha'=>'required',
                'realizado'=>'required',
            ]);
            $horario_id = $compuesta['horario_id'];
            $persona_id = $compuesta['persona_id'];
            $fecha = $compuesta['fecha'];
            MenuPersona::find($horario_id,$persona_id,$fecha)->update($request->all());
            return redirect()->route(self::path.'.index')
                ->with('success','Menu persona actualizado satisfactoriamente');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param App\MenuPersona $alimento
         * @return \Illuminate\Http\Response
         */
        /*public function destroy(MenuPersona $compuesta)
        {
            //
            Log::debug('Recibido: '.$compuesta);
            $horario_id = $compuesta['horario_id'];
            $persona_id = $compuesta['persona_id'];
            $fecha = $compuesta['fecha'];
            MenuPersona::find($horario_id,$persona_id,$fecha)->delete();
            return redirect()->route('MenuPersona.index')
                ->with('success','Menu persona borrado satisfactoriamente');
        }*/
        public function destroy($persona_id,$horario_id,$fecha)
        {
          Log::debug('Se quiere borrar una ración...');
          $info = [
            'acction'=>'false',
            'message'=>'No se pudo eliminar el menu persona (planilla) !!!'
          ];
          try {
            $menuPersona = MenuPersona::findById($horario_id,$persona_id,$fecha);
            if ($menuPersona<>null){
              if (MenuPersona::borrar($menuPersona)){
                $info = [
                  'acction'=>'success',
                  'message'=>'Menu persona actualizado satisfactoriamente'
                ];
              }
            }
          } catch (\Exception $e) {

          }
          return redirect()->route(self::path.'.index',compact('info'));
              #->with('false','No se pudo eliminar el menu persona (planilla) !!!');
        }


}
