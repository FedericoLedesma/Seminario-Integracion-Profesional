<?php

namespace App\Informes;

use App\Informes\InformeRacion_cantidad_de_raciones;
use App\Racion;
use Illuminate\Support\Facades\Log;
use App\Horario;

class InformeRacion
{
  private $_fecha_inicio;
  private $_fecha_final;
  private $_horario_inicio;
  private $_horario_final;
  private $_lista_informeRacion_cantidad_de_raciones;
  #private _id;

  function __construct() {
         $this->_lista_informeRacion_cantidad_de_raciones = Array();
  }

  public static function create_informe_racion($conjunto,$fecha_inicial, $fecha_final, $horario_inicial, $horario_final)
  {
    Log::debug('Creando un informe ración');
    Log::debug('Se recibió el conjunto:');
    foreach ($conjunto as $x) {
      Log::debug($x);
    }
    Log::debug('Fin del conjunto:');
    $informe = new InformeRacion;
    $informe->set_fecha_inicio($fecha_inicial);
    $informe->set_fecha_final($fecha_final);
    $informe->set_horario_inicio($horario_inicial);
    $informe->set_horario_final($horario_final);
    $flag = null;
    $flag_r = null;
    $c = 0;
    $l = Array();
    foreach ($conjunto as $menu) {
      if ($flag == null){
        $flag = $menu->get_racion();
        $flag_r = $menu->realizado;
        Log::debug('Setteada la bandera en '.$flag);
        #array_push($l,$menu);
      }
      #else{
        if (($flag == $menu->get_racion())&&($flag_r==$menu->realizado)){
          $c++;
          Log::debug('Contador en '.$c);
          array_push($l,$menu);
        }
        else{
          $x = new InformeRacion_cantidad_de_raciones;
          $x->set_racion($flag);
          $x->set_cantidad($c);
          $x->set_informe_racion($informe);
          $x->set_realizado((boolean)$flag_r);
          Log::debug('Nuevo informe ración cantidad de raciones '.$x->toString());
          foreach ($l as $m) {
            $x->add($m);
          }
          $informe->add($x,$c);
          $l = Array();
          $c = 1;
          $flag = $menu->get_racion();
          $flag_r = $menu->realizado;
          array_push($l,$menu);
        }
      #}
    }
    if (sizeof($conjunto)>0){
      $x = new InformeRacion_cantidad_de_raciones;
      Log::debug('La variable racion tiene '.$flag);
      $x->set_racion($flag);
      $x->set_cantidad($c);
      $x->set_informe_racion($informe);
      $x->set_realizado((boolean)$flag_r);
      Log::debug('Nuevo informe ración cantidad de raciones '.$x->toString());
      foreach ($l as $m) {
        $x->add($m);
      }
      $informe->add($x,$c);
    }
    return $informe;
  }

  public function add($renglon){
    array_push($this->_lista_informeRacion_cantidad_de_raciones,$renglon);
  }

  public function add_racion_y_cantidad($racion, int $cantidad)
  {
    if ($this->_lista_informeRacion_cantidad_de_raciones==null)
      $this->_lista_informeRacion_cantidad_de_raciones=Array();
    $inf_rac = new InformeRacion_cantidad_de_raciones;
    Log::debug('La variable racion tiene '.$racion);
    $inf_rac->set_racion($racion);
    $inf_rac->set_cantidad($cantidad);
    $inf_rac->set_informe_racion($this);
    array_push($this->_lista_informeRacion_cantidad_de_raciones,$inf_rac);
  }

  public function get_fecha_inicio(){
    return $this->_fecha_inicio;
  }

  public function set_fecha_inicio($fecha_inicio){
    $this->_fecha_inicio = $fecha_inicio;
  }

  public function get_fecha_final(){
    return $this->_fecha_final;
  }

  public function set_fecha_final($fecha_final){
    $this->_fecha_final = $fecha_final;
  }

  public function get_horario_inicio(){
    return $this->_horario_inicio;
  }

  public function set_horario_inicio($horario_inicio){
    $this->_horario_inicio = $horario_inicio;
  }

  public function get_horario_final(){
    return $this->_horario_final;
  }

  public function set_horario_final($horario_final){
    $this->_horario_final = $horario_final;
  }

  public function get_lista(){
    return $this->_lista_informeRacion_cantidad_de_raciones;
  }

  function getJsonData(){
    $var = get_object_vars($this);
    foreach ($var as &$value) {
        if (is_object($value) && method_exists($value,'getJsonData')) {
            $value = $value->getJsonData();
        }
    }
    return $var;
  }

  public static function create_informe_racion_entre_fechas($conjunto,$f_ini,$f_fin){
    $horarios = Horario::all();
    $h_ini = $horarios->min('id');
    $h_fin = $horarios->max('id');
    return static::create_informe_racion($conjunto,$f_ini,$f_fin,$h_ini,$h_fin);
  }

}
