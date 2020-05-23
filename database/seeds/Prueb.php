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
      //--------TIPO DNI---------------
      //--------PERSONA----------------
      $persona=Persona::create([
          'name' => 'p_prueba',
          'numero_doc'=>'1253456',
          'apellido'=>'unlu',
          'direccion'=>'calle',
          'email'=>'prueb-a@gmail.com',
          'provincia'=>'Buenos aires',
          'localidad'=>'Lujan',
          'sexo'=>'M',
          'fecha_nac'=>'1997-08-05',
          'tipo_documento_id'=>'1',
        ]);
        $persona=Persona::create([
            'name' => 'persona2',
            'numero_doc'=>'123497',
            'apellido'=>'unlu',
            'direccion'=>'calle',
            'email'=>'email@hola.com',
            'provincia'=>'Buenos aires',
            'localidad'=>'Lujan',
            'sexo'=>'M',
            'fecha_nac'=>'1997-02-01',
            'tipo_documento_id'=>'1',
          ]);
          $persona=Persona::create([
              'name' => 'persona3',
              'numero_doc'=>'456789',
              'apellido'=>'apellido_3',
              'direccion'=>'calle3',
              'email'=>'email3@hola.com',
              'provincia'=>'Buenos aires',
              'localidad'=>'Merlo',
              'sexo'=>'M',
              'fecha_nac'=>'2000-02-01',
              'tipo_documento_id'=>'1',
            ]);
        //--------PATOLOGIA----------------
        $patologia=Patologia::create([
            'name' => 'patologia_1',

          ]);
          $patologia=Patologia::create([
              'name' => 'diabetes',

            ]);

            //--alimentos

            Alimento::create([
              'name'=>'papa',
            ]);
            Alimento::create([
              'name'=>'arroz',
            ]);
            Alimento::create([
              'name'=>'fideos',
            ]);
            Alimento::create([
              'name'=>'pure de tomate',
            ]);
            Alimento::create([
              'name'=>'cebolla',
            ]);
            Alimento::create([
              'name'=>'carne',
            ]);
            Alimento::create([
              'name'=>'pollo',
            ]);
            Alimento::create([
              'name'=>'leche',
            ]);
            Alimento::create([
              'name'=>'sal',
            ]);
            Alimento::create([
              'name'=>'pera',
            ]);
            Alimento::create([
              'name'=>'pan',
            ]);

      //--------RACION----------------
      Racion::create([
        'name'=>'pollo',
        'observacion'=>'pollo con arroz',
      ]);
      Racion::create([
        'name'=>'te',
        'observacion'=>'te con miel',
      ]);
      Racion::create([
        'name'=>'chocolata',
        'observacion'=>'chocolatada con galletas',
      ]);
      Racion::create([
        'name'=>'guiso',
        'observacion'=>'guiso de arroz',
      ]);
      Racion::create([
        'name'=>'fideos con tuco',
        'observacion'=>'fideos con tuco y carne',
      ]);
      Horario::create([
        'name'=>'desayuno'
      ]);
      Horario::create([
        'name'=>'almuerzo'
      ]);
      Horario::create([
        'name'=>'merienda'
      ]);
      Horario::create([
        'name'=>'cena'
      ]);
      Horario::create([
        'name'=>'colacion'
      ]);
      //--------HORARIO RACION----------------
      HorarioRacion::create([
        'racion_id'=>1,
        'horario_id'=>2,
      ]);
      HorarioRacion::create([
        'racion_id'=>1,
        'horario_id'=>4,
      ]);
      HorarioRacion::create([
        'racion_id'=>2,
        'horario_id'=>1,
      ]);
      HorarioRacion::create([
        'racion_id'=>2,
        'horario_id'=>3,
      ]);
      HorarioRacion::create([
        'racion_id'=>3,
        'horario_id'=>1,
      ]);
      HorarioRacion::create([
        'racion_id'=>4,
        'horario_id'=>4,
      ]);
      //---------RACIONES DISPONIBLES-----------------------

      RacionesDisponibles::create([
        'racion_id'=>1,
        'fecha'=>'2020-05-15',
        'horario_id'=>2,
        'stock_original'=>10,
        'cantidad_restante'=>10,
        'cantidad_realizados'=>0,
      ]);
      RacionesDisponibles::create([
        'racion_id'=>1,
        'fecha'=>'2020-05-15',
        'horario_id'=>4,
        'stock_original'=>10,
        'cantidad_restante'=>10,
        'cantidad_realizados'=>0,
      ]);
      RacionesDisponibles::create([
        'racion_id'=>2,
        'fecha'=>'2020-05-15',
        'horario_id'=>1,
        'stock_original'=>10,
        'cantidad_restante'=>10,
        'cantidad_realizados'=>0,
      ]);
      RacionesDisponibles::create([
        'racion_id'=>2,
        'fecha'=>'2020-05-15',
        'horario_id'=>3,
        'stock_original'=>10,
        'cantidad_restante'=>10,
        'cantidad_realizados'=>0,
      ]);
      RacionesDisponibles::create([
        'racion_id'=>3,
        'fecha'=>'2020-05-15',
        'horario_id'=>1,
        'stock_original'=>10,
        'cantidad_restante'=>10,
        'cantidad_realizados'=>0,
      ]);
      RacionesDisponibles::create([
        'racion_id'=>4,
        'fecha'=>'2020-05-15',
        'horario_id'=>4,
        'stock_original'=>10,
        'cantidad_restante'=>10,
        'cantidad_realizados'=>0,
      ]);
      //---------PERSONAL-----------------------------------
      Personal::create([
        'id'=>2,
      ]);
      //-----------DIETA------------------------------
      Dieta::create([
        'patologia_id'=>1,
        'observacion'=>'patologia1',
        'personal_id'=>1,
      ]);
      Dieta::create([
        'patologia_id'=>2,
        'observacion'=>'dbt',
        'personal_id'=>1,
      ]);
      //------MENU PERSONA----------------------
    

    }
}
