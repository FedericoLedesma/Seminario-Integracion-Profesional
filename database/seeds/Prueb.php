<?php

use Illuminate\Database\Seeder;
use App\Persona;
use App\Paciente;
use App\Alimento;
use App\Acompanante;
use App\Personal;
use App\TipoDocumento;
use App\Patologia;
use App\Horario;
use App\Racion;
use App\HorarioRacion;
use App\RacionesDisponibles;
use App\MenuPersona;
use App\Dieta;
use App\Sector;
use App\User;
use App\Movimiento;
use App\DietaActiva;
use Spatie\Permission\Models\Permission;
class Prueb extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*$fecha=new DateTime(date("Y-m-d"));
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
      /*$raciones_disponibles=RacionesDisponibles::getRacionesDisponiblesPatologias($persona->patologias,$fecha,1);
      foreach ($raciones_disponibles as $r) {

        //  echo $r."----------";
      }*/
      /*$fecha=new DateTime(date("Y-m-d"));
      $racion=Racion::findById(14);
      $dietas_activas=DietaActiva::all();
      foreach ($dietas_activas as $dieta_activa) {
        $r=$dieta_activa->raciones()->where('racion_id',$racion->id)->first();
        if(!(empty($r))){
          Log::info("r - ".$r->pivot);
          $dieta_activa->raciones()->detach($racion);
        }
      }

      foreach ($dietas_activas as $dietaActiva) {
        $alimentos_patologia=$dietaActiva->dieta->patologia->alimentos;
        $b=true;
        foreach ($racion->alimentos as $alimento) {
          foreach ($alimentos_patologia as $a_p) {
            if($a_p->name==$alimento->name){
              $b=false;
            }
          }
        }if($b){
          $dietaActiva->raciones()->attach($racion,['fecha'=>$fecha]);
        }

      }
      */
    //  $acompanante=Acompanante::findById(1);
      //echo $acompanante->paciente;
     //$racion=Racion::findById(2);
    /* foreach ($racion->racion_alimentos as $r_a) {
       echo $r_a->alimento->name."  ".$r_a->cantidad."  ".$r_a->unidad->name;
       // code...
     }*/
     /*$s=$racion->racion_alimento(2)->unidad->name;
     echo $s;*/
     /*$personal=Personal::findById(9);
     $sector=Sector::findById(2);
     $personal->reubicar_personal($sector);*/
     $paciente=Paciente::findById(5);
     if($paciente->persona->tiene_menu_hoy_en_horario(1)){
       echo "tiene menu";
     }else{
       echo "no tiene menu";
     }
    }
}
