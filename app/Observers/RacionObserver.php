<?php

namespace App\Observers;

use App\Racion;
use App\DietaActiva;
use DateTime;
use Illuminate\Support\Facades\Log;

class RacionObserver
{
    /**
     * Handle the racion "created" event.
     *
     * @param  \App\Racion  $racion
     * @return void
     */
    public function created(Racion $racion)
    {
      Log::debug('Pase por RacionObserver en created, '.$racion);
    }

    /**
     * Handle the racion "updated" event.
     *
     * @param  \App\Racion  $racion
     * @return void
     */
    public function updated(Racion $racion)
    {
      Log::debug('Pase por RacionObserver en update, '.$racion);

    }

    /**
     * Handle the racion "deleted" event.
     *
     * @param  \App\Racion  $racion
     * @return void
     */
    public function deleted(Racion $racion)
    {
        //
    }
    public function saved(Racion $racion)
    {
      Log::debug('Pase por RacionObserver en saved, '.$racion);
      Log::info($racion->id);

      $fecha= new DateTime(date("Y-m-d"));
      $dietas_activas=DietaActiva::all();
      /**
      La racion pudo cambiar los alimentos entonces se la debe quitar de las dietas
      y volver a verificar que cumpla con los alimentos prohibidos.
      **/
      foreach ($dietas_activas as $dieta_activa) {
        $r=$dieta_activa->raciones()->where('racion_id',$racion->id)->first();
        if(!(empty($r))){
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
    }
    /**
     * Handle the racion "restored" event.
     *
     * @param  \App\Racion  $racion
     * @return void
     */
    public function restored(Racion $racion)
    {
        //
    }

    /**
     * Handle the racion "force deleted" event.
     *
     * @param  \App\Racion  $racion
     * @return void
     */
    public function forceDeleted(Racion $racion)
    {
        //
    }
}
