<?php

namespace App\Observers;

use App\MenuPersona;
use App\Movimiento;
use App\RacionesDisponibles;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DateTime;

class MenuPersonaObserver
{
    /**
     * Handle the menu persona "created" event.
     *
     * @param  \App\MenuPersona  $menuPersona
     * @return void
     */
    public function created(MenuPersona $menuPersona)
    {
        //
        Log::debug('Pase por MenuPersonaObserver en created, '.$menuPersona);
        //$r = RacionesDisponibles::findById($menuPersona->horario_id,$menuPersona->racion_id,$menuPersona->fecha);
        #Log::debug('Desde observer tengo: , '.$r);
        /*RacionesDisponibles::where('horario_id','=', $menuPersona->horario_id)
        ->where('racion_id','=', $menuPersona->racion_id)
        ->where('fecha','=', $menuPersona->fecha)
        ->update([
          'cantidad_realizados'=>$r->cantidad_realizados+1,
          'cantidad_restante'=>$r->cantidad_restante-1
        ]);*/
        /*if ($r->cantidad_restante<=0){
          return false;
        }
        else{
          $r->where('horario_id','=', $menuPersona->horario_id)
          ->where('racion_id','=', $menuPersona->racion_id)
          ->where('fecha','=', $menuPersona->fecha)
          ->update(['cantidad_realizados'=>$r->cantidad_realizados+1,
          'cantidad_restante'=>$r->cantidad_restante-1]);
        }*/
        #return true;
        $rd=$menuPersona->racionDisponible;
        $rd->cantidad_restante=$rd->cantidad_restante-1;
        $rd->guardar();
    }
   public function creating(MenuPersona $menuPersona)
   {
       //
       /*Log::debug('Pase por MenuPersonaObserver en saving');
       $r = RacionesDisponibles::findById($menuPersona->horario_id,$menuPersona->racion_id,$menuPersona->fecha);
       $r->cantidad_realizados += 1;*/
       #return true;

       Log::debug('Pase por MenuPersonaObserver en creating, '.$menuPersona);
       $r = RacionesDisponibles::findById($menuPersona->horario_id,$menuPersona->racion_id,$menuPersona->fecha);
       if( $r<>null)
		   if ($r->cantidad_restante<=0){
			 return false;
       }
   }

   public function updating(MenuPersona $menuPersona)
   {
       //
       /*Log::debug('Pase por MenuPersonaObserver en saving');
       $r = RacionesDisponibles::findById($menuPersona->horario_id,$menuPersona->racion_id,$menuPersona->fecha);
       $r->cantidad_realizados += 1;*/
       #return true;

   }

    /**
     * Handle the menu persona "updated" event.
     *
     * @param  \App\MenuPersona  $menuPersona
     * @return void
     */
  /*  public function updated(MenuPersona $menuPersona)
    {
        //
        if(($menuPersona->persona_id<>$menuPerona->getOriginal('persona_id'))
          ||($menuPersona->racion_id<>$menuPerona->getOriginal('racion_id'))
          ||($menuPersona->fecha<>$menuPerona->getOriginal('fecha'))
        ){
          $r = RacionesDisponibles::findById($menuPersona->horario_id,$menuPersona->racion_id,$menuPersona->fecha);
          /*$r->cantidad_realizados += 1;*/
      /*    $r->where('horario_id','=', $menuPersona->horario_id)
          ->where('racion_id','=', $menuPersona->racion_id)
          ->where('fecha','=', $menuPersona->fecha)
          ->update(['cantidad_realizados'=>$r->cantidad_realizados+1,
          'cantidad_restante'=>$r->cantidad_restante-1]);
          $r = RacionesDisponibles::findById($menuPersona->getOriginal('horario_id'),$menuPersona->getOriginal('racion_id'),$menuPersona->getOriginal('fecha'));
          /*$r->cantidad_realizados -= 1;*/
      /*    $r->where('horario_id','=', $menuPersona->getOriginal('horario_id'))
          ->where('racion_id','=', $menuPersona->getOriginal('racion_id'))
          ->where('fecha','=', $menuPersona->getOriginal('fecha'))
          ->update(['cantidad_realizados'=>$r->cantidad_realizados-1,
          'cantidad_restante'=>$r->cantidad_restante+1]);
        }
        return true;
    }*/

    /**
     * Handle the menu persona "deleted" event.
     *
     * @param  \App\MenuPersona  $menuPersona
     * @return void
     */
    public function deleted(MenuPersona $menuPersona)
    {
        //
        $rd=$menuPersona->racionDisponible;
        $rd->cantidad_restante=$rd->cantidad_restante+1;
        $rd->guardar();
    }
    public function saved(MenuPersona $menuPersona)
    {

      $rd=$menuPersona->racionDisponible;
      $user=Auth::user();
      if($menuPersona->is_realizado()){
        $rd->stock_original=$rd->stock_original-1;
        $rd->guardar();
        $creado=new DateTime(date("Y-m-d H:i:s"));
        $movimiento=Movimiento::create([
          'racion_disponible_id'=>$rd->id,
          'creado'=>$creado,
          'user_id'=>$user->personal->id,
          'tipo_movimiento_id'=>2,
          'cantidad'=>'1',
        ]);
      }
    }
    /**
     * Handle the menu persona "restored" event.
     *
     * @param  \App\MenuPersona  $menuPersona
     * @return void
     */
    public function restored(MenuPersona $menuPersona)
    {
        //
    }

    /**
     * Handle the menu persona "force deleted" event.
     *
     * @param  \App\MenuPersona  $menuPersona
     * @return void
     */
    public function forceDeleted(MenuPersona $menuPersona)
    {
        //
    }
}
