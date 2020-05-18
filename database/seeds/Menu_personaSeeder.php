<?php

use Illuminate\Database\Seeder;
use App\Horario;
use App\HorarioRacion;
use App\RacionesDisponibles;
use App\Personal;
use App\Persona;
use App\Racion;
use App\TipoDocumento;
use App\MenuPersona;
use Carbon\Carbon;

class Menu_personaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $horario = Horario::create([
            'name'=>'quinta_cena'
        ]);
        $racion = Racion::create([
            'name'=>'hamburgesa',
            'observacion'=>'triple carne'
        ]);

        HorarioRacion::create([
            'horario_id'=>$racion->id,
            'racion_id'=>$racion->id
        ]);

        $rac_dis = RacionesDisponibles::create([
            'racion_id'=>$racion->id, 
            'fecha'=>Carbon::now(), 
            'horario_id'=>$horario->id,
            'stock_original'=>1000,
            'cantidad_restante'=>1000,
            'cantidad_realizados'=>0,
        ]);

        $tipo_doc = TipoDocumento::create([
            'name'=>'DNI'
        ]);

        $persona = Persona::create([
            #'id'=>1,
            'name'=>'pepe',
            'apellido'=>'carlitos',
            'tipo_documento_id'=>$tipo_doc->id,
            'numero_doc'=>66666666,
            'direccion'=>'10 n° 100',
            'email'=>'a',
            'provincia'=>'a',
            'localidad'=>' a', 
            'sexo'=>'a',
            'fecha_nac'=>Carbon::now()
        ]);

        $personal_aux = Persona::create([
            #'id'=>2,
            'name'=>'fulanito',
            'apellido'=>'gomez',
            'tipo_documento_id'=>$tipo_doc->id,
            'numero_doc'=>55555555,
            'direccion'=>'11 n° 100',
            'email'=>'a',
            'provincia'=>'a',
            'localidad'=>'a', 
            'sexo'=>'a',
            'fecha_nac'=>Carbon::now()
        ]);
        
        $personal = Personal::create([
            'id'=>$personal_aux->id,
            'matricula'=>55555555
        ]);
        
        MenuPersona::create([
            'persona_id'=>$persona->id,
            'horario_id'=>$rac_dis->horario_id,
            'racion_id'=>$rac_dis->racion_id, 
            'fecha'=>$rac_dis->fecha,
            'personal_id'=>2,
            #'dieta_id',
            'realizado'=>false,
        ]);


    }
}