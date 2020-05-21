<?php

use Illuminate\Database\Seeder;
use App\Persona;
use App\TipoDni;
use App\Patologia;
use App\TipoPatologia;
use App\Paciente;
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
*/
    $persona=Persona::findById(3);
$rd=RacionesDisponibles::findById(1,3,$fecha);
    echo $rd;

    $rd->cantidad_realizados=5;
    $rd->guardar();
    echo $rd;
    }


}
