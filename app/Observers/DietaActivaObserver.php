<?php

namespace App\Observers;

use App\DietaActiva;
use App\Racion;
use Illuminate\Support\Facades\Log;
use DateTime;

class DietaActivaObserver
{
    /**
     * Handle the dieta activa "created" event.
     *
     * @param  \App\DietaActiva  $dietaActiva
     * @return void
     */
    public function created(DietaActiva $dietaActiva)
    {
      Log::debug('Pase por DietaActivaObserver en create, '.$dietaActiva);
      Log::info($dietaActiva->dieta_id);
     $fecha= new DateTime(date("Y-m-d"));
      $alimentos_patologia=$dietaActiva->dieta->patologia->alimentos;
        $raciones=Racion::all();
        foreach ($raciones as $racion) {
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
    public function creating(DietaActiva $dietaActiva)
    {
      Log::debug('Pase por DietaActivaObserver en creating, '.$dietaActiva);
      Log::info($dietaActiva->dieta_id);

    }
    /**
     * Handle the dieta activa "updated" event.
     *
     * @param  \App\DietaActiva  $dietaActiva
     * @return void
     */
    public function updated(DietaActiva $dietaActiva)
    {
      Log::info("updated-observer");

    }

    /**
     * Handle the dieta activa "deleted" event.
     *
     * @param  \App\DietaActiva  $dietaActiva
     * @return void
     */
    public function deleted(DietaActiva $dietaActiva)
    {
        //
    }

    /**
     * Handle the dieta activa "restored" event.
     *
     * @param  \App\DietaActiva  $dietaActiva
     * @return void
     */
    public function restored(DietaActiva $dietaActiva)
    {
        //
    }

    /**
     * Handle the dieta activa "force deleted" event.
     *
     * @param  \App\DietaActiva  $dietaActiva
     * @return void
     */
    public function forceDeleted(DietaActiva $dietaActiva)
    {
        //
    }
}
