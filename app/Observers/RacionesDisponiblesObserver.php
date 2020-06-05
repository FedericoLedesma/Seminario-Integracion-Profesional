<?php

namespace App\Observers;

use App\RacionesDisponibles;

class RacionesDisponiblesObserver
{
    /**
     * Handle the raciones disponibles "created" event.
     *
     * @param  \App\RacionesDisponibles  $racionesDisponibles
     * @return void
     */
  /*  public function creating(RacionesDisponibles $racionesDisponibles)
    {
        //
        if($racionesDisponibles->stock<0){
          return false;
        }
        $racionesDisponibles->cantidad_restante = $racionesDisponibles->stock_original;
        $racionesDisponibles->cantidad_realizados = 0;
        return true;
    }*/
  /*  public function created(RacionesDisponibles $racionesDisponibles)
    {
        //
        if($racionesDisponibles->stock<0){
          return false;
        }
        $racionesDisponibles->cantidad_restante = $racionesDisponibles->stock_original;
        $racionesDisponibles->cantidad_realizados = 0;
        return true;
    }*/

    /**
     * Handle the raciones disponibles "updated" event.
     *
     * @param  \App\RacionesDisponibles  $racionesDisponibles
     * @return void
     */
    public function updating(RacionesDisponibles $racionesDisponibles)
    {
        //
        if ($racionesDisponibles->cantidad_realizados<>$racionesDisponibles->getOriginal('cantidad_realizados'))
          return false;
        if ($racionesDisponibles->cantidad_restante<>$racionesDisponibles->getOriginal('cantidad_restante'))
          return false;
        if ($racionesDisponibles->cantidad_realizados<>$racionesDisponibles->getOriginal('cantidad_realizados')){
          $racionesisponibles->cantidad_restante-=($racionesDisponibles->cantidad_realizados - $racionesDisponibles->getOriginal('cantidad_realizados'));
        }
        return true;
    }

    /**
     * Handle the raciones disponibles "deleted" event.
     *
     * @param  \App\RacionesDisponibles  $racionesDisponibles
     * @return void
     */
    public function deleted(RacionesDisponibles $racionesDisponibles)
    {
        //
    }

    /**
     * Handle the raciones disponibles "restored" event.
     *
     * @param  \App\RacionesDisponibles  $racionesDisponibles
     * @return void
     */
    public function restored(RacionesDisponibles $racionesDisponibles)
    {
        //
    }

    /**
     * Handle the raciones disponibles "force deleted" event.
     *
     * @param  \App\RacionesDisponibles  $racionesDisponibles
     * @return void
     */
    public function forceDeleted(RacionesDisponibles $racionesDisponibles)
    {
        //
    }
}
