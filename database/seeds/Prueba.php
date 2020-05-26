<?php

use Illuminate\Database\Seeder;
use App\Persona;
use App\TipoDni;
use App\Patologia;
use App\TipoPatologia;
use App\Paciente;
use App\Racion;
use App\Alimento;
use App\Acompanante;
use App\RacionesDisponibles;
use App\MenuPersona;
use Illuminate\Support\Facades\Log;
class Prueba extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $fecha= new DateTime(date("Y-m-d"));
    /*$racionesDisponibles=RacionesDisponibles::allDisponibles(1,$fecha)->get();
    if($racionesDisponibles){
      //echo $racionesDisponibles;
    }

    $menuPersona=MenuPersona::allFecha($fecha)->get();
    if($menuPersona){
    //  echo $menuPersona;
    }
    $tipoPatologia=TipoPatologia::findById(4);
    $tipoPatologia->delete();
    $patologias=Patologia::findByTipoPatologia(4)->get();
    echo count($patologias);

    $p=Patologia::create([
      'name'=>'p1',
    ]);

    $alimento=Alimento::create([
      'name'=>'alimento1',
    ]);*/
    $horarioId=1;
    $racion=Racion::findById(1);

    $horario_racion_id=$racion->horarios()->wherePivot('horario_id',$horarioId)->first()->pivot->id;
  //  $rd->eliminar();
    //echo $rd;
    echo $horario_racion_id;

    if($horario_racion_id){
      $creado=new DateTime(date("Y-m-d H:i:s"));
      $racionDisponible=RacionesDisponibles::create([
          'horario_racion_id' => $horario_racion_id,
          'fecha' => $fecha,
          'stock_original' => 0,
          'cantidad_restante' =>0,
          'cantidad_realizados' => 0,
        ]);
      }


    }


}
