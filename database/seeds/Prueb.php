<?php

use Illuminate\Database\Seeder;
use App\Persona;
use App\Alimento;
use App\Personal;
use App\TipoDocumento;
use App\Patologia;
use App\Horario;
use App\Racion;
use App\HorarioRacion;
use App\RacionesDisponibles;
use App\MenuPersona;
use App\Dieta;
class Prueb extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $fecha=new DateTime(date("Y-m-d"));
      $persona=Persona::findById(5);
      echo $persona->patologias;
    /*  foreach ($persona->patologias as $patologia) {
        $dieta=$patologia->dieta->dietaActiva->where('fecha_final','=',null)->first();
        $raciones=$dieta->raciones;
        foreach ($raciones as $racion) {
          // code...
          $r=RacionesDisponibles::findByHorarioRacionFecha(1,$racion->id,$fecha);
            echo("Raciondisp ".$r);


        }
      }*/
      //RacionesDisponibles::findByHorarioRacionFecha();
      $raciones_disponibles=RacionesDisponibles::getRacionesDisponiblesPatologias($persona->patologias,$fecha,1);
      foreach ($raciones_disponibles as $r) {

        //  echo $r."----------";
      }

    }
}
