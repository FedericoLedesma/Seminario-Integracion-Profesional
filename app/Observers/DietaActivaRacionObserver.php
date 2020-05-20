<?php

namespace App\Observers;

use App\DietaActivaRacion;

class DietaActivaRacionObserver
{
    /**
     * Handle the dieta activa racion "created" event.
     *
     * @param  \App\DietaActivaRacion  $dietaActivaRacion
     * @return void
     */
    public function creating(DietaActivaRacion $dietaActivaRacion)
    {
        //
        $rac = $dietaActivaRacion->get_racion();
        $list_al = $dietaActivaRacion->get_alimentos_prohibidos();
        return $rac->contiene_determinada_lista_alimento($list_ar);
    }

    /**
     * Handle the dieta activa racion "updated" event.
     *
     * @param  \App\DietaActivaRacion  $dietaActivaRacion
     * @return void
     */
    public function updating(DietaActivaRacion $dietaActivaRacion)
    {
        //
        if(($dietaActivaRacion->dieta_id<>$dietaActivaRacion->getOriginal('dieta_id'))
          ||($dietaActivaRacion->fecha<>$dietaActivaRacion->getOriginal('fecha'))
        ){
          $rac = $dietaActivaRacion->get_racion();
          $list_al = $dietaActivaRacion->get_alimentos_prohibidos();
          return $rac->contiene_determinada_lista_alimento($list_ar);
        }
        return true;
    }

    /**
     * Handle the dieta activa racion "deleted" event.
     *
     * @param  \App\DietaActivaRacion  $dietaActivaRacion
     * @return void
     */
    public function deleted(DietaActivaRacion $dietaActivaRacion)
    {
        //
    }

    /**
     * Handle the dieta activa racion "restored" event.
     *
     * @param  \App\DietaActivaRacion  $dietaActivaRacion
     * @return void
     */
    public function restored(DietaActivaRacion $dietaActivaRacion)
    {
        //
    }

    /**
     * Handle the dieta activa racion "force deleted" event.
     *
     * @param  \App\DietaActivaRacion  $dietaActivaRacion
     * @return void
     */
    public function forceDeleted(DietaActivaRacion $dietaActivaRacion)
    {
        //
    }
}
