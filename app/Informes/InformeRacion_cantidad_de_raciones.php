<?php

namespace App\Informes;

use App\Informes\InformeRacion;
use App\Racion;

class InformeRacion_cantidad_de_raciones
{
  private $_racion;
  private $_lista_menu_persona;
  private $_cantidad;
  private $_informe_racion;
  private $_realizado;

  public function get_racion(){
    return $this->_racion;
  }

  public function set_racion($racion){
    $this->_racion = $racion;
  }

  public function get_cantidad(){
    return $this->_cantidad;
  }

  public function set_cantidad(int $cantidad){
    $this->_cantidad = $cantidad;
  }

  public function get_informe_racion(){
    return $this->_informe_racion;
  }

  public function set_informe_racion(InformeRacion $informe_racion){
    $this->_informe_racion = $informe_racion;
  }

  public function is_realizado(){
    return $this->_realizado;
  }

  public function set_realizado(bool $realizado){
    $this->_realizado = $realizado;
  }

  public function change_menu_persona_to_realizado(bool $realziado){
    $this->_realizado = $realizado;
    foreach ($this->_lista_menu_persona as $menu) {
      // code...
      $menu->set_realizado($realizado);
    }
  }

  public function get_racion_name(){
    return $this->_racion->name;
  }

  public function toString(){
    return ' '.$this->get_racion_name(). ' cantidad: '.$this->_cantidad;
  }

  function __construct() {
         $this->_lista_menu_persona = Array();
  }

  public function add($x){
    array_push($this->_lista_menu_persona,$x);
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
}
