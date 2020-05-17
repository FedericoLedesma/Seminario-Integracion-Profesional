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
class Prueba extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $fecha= new DateTime('2020-05-15');
    $racionesDisponibles=RacionesDisponibles::allDisponibles(1,$fecha)->get();
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
    }
}
