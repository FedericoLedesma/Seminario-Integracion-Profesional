<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Racion;
use App\Alimento;
use App\Horario;
use App\Persona;
use App\Paciente;
use App\Personal;
use App\Acompanante;
use App\TipoDocumento;
use App\HorarioRacion;
use App\RacionesDisponibles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        static::cargar_raciones_disponibles();
    }

    public static function cargar_admin_y_permisos(){
      User::create([
          'dni' => '1234',
          'name'=>'admin',
          'password'=>bcrypt('12345678'),

      ]);
      Role::create([
          'name' => 'Super-User',
          'guard_name'=>'web',
      ]);

      Permission::create([
          'name' => 'alta_usuarios',
          'guard_name'=>'web',
      ]);
      Permission::create([
          'name' => 'ver_usuarios',
          'guard_name'=>'web',
      ]);

      Permission::create([
          'name' => 'modificacion_usuarios',
          'guard_name'=>'web',
      ]);
      Permission::create([
          'name' => 'baja_usuarios',
          'guard_name'=>'web',
      ]);

      Permission::create([
          'name' => 'alta_roles',
          'guard_name'=>'web',
      ]);
      Permission::create([
          'name' => 'baja_roles',
          'guard_name'=>'web',
      ]);
      Permission::create([
          'name' => 'modificacion_roles',
          'guard_name'=>'web',
      ]);
      Permission::create([
          'name' => 'ver_roles',
          'guard_name'=>'web',
      ]);

      Permission::create([
          'name' => 'alta_permisos',
          'guard_name'=>'web',
      ]);
      Permission::create([
          'name' => 'baja_permisos',
          'guard_name'=>'web',
      ]);

      Permission::create([
          'name' => 'ver_permisos',
          'guard_name'=>'web',
      ]);

      Permission::create([
      'name' => 'ver_menu_persona',
      'guard_name'=>'web',
      ]);

      Permission::create([
      'name' => 'modificacion_menu_persona',
      'guard_name'=>'web',
      ]);

      Permission::create([
      'name' => 'alta_menu_persona',
      'guard_name'=>'web',
      ]);

      Permission::create([
      'name' => 'baja_menu_persona',
      'guard_name'=>'web',
      ]);

      $user=User::find('1');
      $role=Role::create(['name'=>'Administrador']);
      $permisos=Permission::all();
      foreach($permisos as $permiso){
      $role->givePermissionTo($permiso);
      }
      $user->assignRole('Administrador');
    }

    private static function cargar_raciones_ali(){
      $r1 = Racion::create([
        'name'=>'churrasco con fideos',
      ]);

      $r2 = Racion::create([
        'name'=>'milanesa con pure de papas',
      ]);

      $r3 = Racion::create([
        'name'=>'pizza de cebolla',
      ]);

      $r4 = Racion::create([
        'name'=>'te con galletitas y flan',
      ]);

      $r5 = Racion::create([
        'name'=>'gelatinas con galletitas y mermelada',
      ]);

      $r6 = Racion::create([
        'name'=>'sopa',
      ]);

      $a1 = Alimento::create([
        'name'=>'lechuga'
      ]);

      $a2 = Alimento::create([
        'name'=>'carne de vaca'
      ]);

      $a3 = Alimento::create([
        'name'=>'galletitas de agua'
      ]);

      $a4 = Alimento::create([
        'name'=>'cebolla'
      ]);

      $a5 = Alimento::create([
        'name'=>'fideos'
      ]);

      $a6 = Alimento::create([
        'name'=>'mermelada'
      ]);

      $r1->add_alimento($a2,100);
      $r1->add_alimento($a5,100);
      $r2->add_alimento($a2,200);
      $r3->add_alimento($a4,200);
      $r4->add_alimento($a3,200);
      $r5->add_alimento($a3,200);
      $r5->add_alimento($a6,200);
      $r6->add_alimento($a1,200);
      $r6->add_alimento($a4,200);

    }

    private static function cargar_horarios(){
      $data = [
        'name'=>'desayuno'
      ];
      $h1 = new Horario($data);
      $h1->save();
      $data = [
        'name'=>'colación'
      ];
      $h2 = new Horario($data);
      $h2->save();
      $data = [
        'name'=>'almuerzo'
      ];
      $h3 = new Horario($data);
      $h3->save();
      $data = [
        'name'=>'merienda'
      ];
      $h4 = new Horario($data);
      $h4->save();
      $data = [
        'name'=>'cena'
      ];
      $h5 = new Horario($data);
      $h5->save();
    }

    private static function cargar_tipo_documentos(){
      $data =[
        'name'=>'DNI'
      ];
      $t1 = new TipoDocumento($data);
      $t1->save();
      $data =[
        'name'=>'libreta cívica'
      ];
      $t2 = new TipoDocumento($data);
      $t2->save();
      $data =[
        'name'=>'indocumentado'
      ];
      $t3 = new TipoDocumento($data);
      $t3->save();
      $data =[
        'name'=>'pasaporte'
      ];
      $t4 = new TipoDocumento($data);
      $t4->save();
    }

    private static function cargar_personas(){
      static::cargar_tipo_documentos();
      $data = [
        'numero_doc'=>66666666,
        'apellido'=>'gomez',
        'name'=>'juan',
        'observacion'=>'OK',
        'direccion'=>'independencia 601',
        'email'=>'juan@test.com',
        'provincia'=>'buenos aires',
        'localidad'=>'moreno',
        'sexo'=>'masculino',
        'fecha_nac'=>'1960-5-5',
        'tipo_documento_id'=>1,
      ];
      $p1 = new Persona($data);
      $p1->save();
      $data = [
        'numero_doc'=>77777777,
        'apellido'=>'lopez',
        'name'=>'juan',
        'observacion'=>'OK',
        'direccion'=>'rivadavia 36001',
        'email'=>'lopez.juan@test.com',
        'provincia'=>'buenos aires',
        'localidad'=>'-',
        'sexo'=>'masculino',
        'fecha_nac'=>'1960-5-5',
        'tipo_documento_id'=>1,
      ];
      $p2 = new Persona($data);
      $p2->save();
      $data = [
        'numero_doc'=>66666665,
        'apellido'=>'gomez',
        'name'=>'juan',
        'observacion'=>'OK',
        'direccion'=>'independencia 606',
        'email'=>'juan2@test.com',
        'provincia'=>'buenos aires',
        'localidad'=>'moreno',
        'sexo'=>'masculino',
        'fecha_nac'=>'1960-5-5',
        'tipo_documento_id'=>1,
      ];
      $p3 = new Persona($data);
      $p3->save();
      $data = [
        'numero_doc'=>88888888,
        'apellido'=>'ricardi',
        'name'=>'carla',
        'observacion'=>'OK',
        'direccion'=>'-',
        'email'=>'carla@test.com',
        'provincia'=>'buenos aires',
        'localidad'=>'luján',
        'sexo'=>'femenino',
        'fecha_nac'=>'1970-5-5',
        'tipo_documento_id'=>1,
      ];
      $p4 = new Persona($data);
      $p4->save();
      $data = [
        'numero_doc'=>99999999,
        'apellido'=>'fernandez',
        'name'=>'maria',
        'observacion'=>'OK',
        'direccion'=>'calle 14 n° 355',
        'email'=>'-',
        'provincia'=>'buenos aires',
        'localidad'=>'san andrés de giles',
        'sexo'=>'femenino',
        'fecha_nac'=>'1980-5-5',
        'tipo_documento_id'=>1,
      ];
      $p5 = new Persona($data);
      $p5->save();
      $data = [
        'numero_doc'=>44444444,
        'apellido'=>'pepe',
        'name'=>'pepe',
        'observacion'=>'OK',
        'direccion'=>'-',
        'email'=>'-',
        'provincia'=>'-',
        'localidad'=>'-',
        'sexo'=>'masculino',
        'fecha_nac'=>null,
        'tipo_documento_id'=>1,
      ];
      $p6 = new Persona($data);
      $p6->save();
      $data = [
        'numero_doc'=>0,
        'apellido'=>'',
        'name'=>'Accidente moto 2020-5-5',
        'observacion'=>'Persona no identificada (amnesia)',
        'direccion'=>'-',
        'email'=>'-',
        'provincia'=>'-',
        'localidad'=>'-',
        'sexo'=>'masculino',
        'fecha_nac'=>null,
        'tipo_documento_id'=>3,
      ];
      $p7 = new Persona($data);
      $p7->save();
      $data = [
        'numero_doc'=>33333333,
        'apellido'=>'gonzalez',
        'name'=>'gabriela',
        'observacion'=>'OK',
        'direccion'=>'-',
        'email'=>'-',
        'provincia'=>'buenos aires',
        'localidad'=>'-',
        'sexo'=>'femenino',
        'fecha_nac'=>'1990-5-5',
        'tipo_documento_id'=>1,
      ];
      $p8 = new Persona($data);
      $p8->save();
      $data = [
        'numero_doc'=>66666666,
        'apellido'=>'oliverti',
        'name'=>'ricardo',
        'observacion'=>'OK',
        'direccion'=>'independencia 600',
        'email'=>'-',
        'provincia'=>'misiones',
        'localidad'=>'misiones',
        'sexo'=>'masculino',
        'fecha_nac'=>'1960-5-5',
        'tipo_documento_id'=>1,
      ];
      $p9 = new Persona($data);
      $p9->save();
      $data = [
        'numero_doc'=>77777777,
        'apellido'=>'gomez',
        'name'=>'juan',
        'observacion'=>'OK',
        'direccion'=>'independencia 600',
        'email'=>'-',
        'provincia'=>'buenos aires',
        'localidad'=>'moreno',
        'sexo'=>'masculino',
        'fecha_nac'=>'1960-5-5',
        'tipo_documento_id'=>1,
      ];
      $p10 = new Persona($data);
      $p10->save();
      $data = [
        'numero_doc'=>66666666,
        'apellido'=>'gomez',
        'name'=>'juan',
        'observacion'=>'OK',
        'direccion'=>'independencia 600',
        'email'=>'-',
        'provincia'=>'buenos aires',
        'localidad'=>'moreno',
        'sexo'=>'masculino',
        'fecha_nac'=>'1960-5-5',
        'tipo_documento_id'=>1,
      ];
    }

    private static function cargar_personal(){
      static::cargar_personas();
      $data = [
        'id'=>1,
        'matricula'=>11111111
      ];
      $p1 = new Personal($data);
      $p1->save();
      $data = [
        'id'=>2,
        'matricula'=>22222222
      ];
      $p2 = new Personal($data);
      $p2->save();
      $data = [
        'id'=>3,
        'matricula'=>33333333
      ];
      $p3 = new Personal($data);
      $p3->save();
      $data = [
        'id'=>4,
        'matricula'=>44444444
      ];
      $p4 = new Personal($data);
      $p4->save();
    }

    private static function cargar_horario_racion(){
      static::cargar_raciones_ali();
      static::cargar_horarios();
      $data =[
        'racion_id'=>1,
        'horario_id'=>3
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>1,
        'horario_id'=>5
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>2,
        'horario_id'=>3
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>2,
        'horario_id'=>5
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>3,
        'horario_id'=>3
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>3,
        'horario_id'=>5
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>4,
        'horario_id'=>1
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>4,
        'horario_id'=>2
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>4,
        'horario_id'=>4
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>5,
        'horario_id'=>1
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>5,
        'horario_id'=>2
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>5,
        'horario_id'=>4
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>6,
        'horario_id'=>1
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>6,
        'horario_id'=>2
      ];
      $r = new HorarioRacion($data);
      $r->save();
      $data =[
        'racion_id'=>6,
        'horario_id'=>4
      ];
      $r = new HorarioRacion($data);
      $r->save();
    }

    public static function cargar_raciones_disponibles(){
      static::cargar_horario_racion();
      static::cargar_personal();
      $menu_raciones = HorarioRacion::all();
      foreach ($menu_raciones as $x) {
        // code...
        Log::debug('Método cargar raciones disponibles: se encontró un horario racion: '.$x);
        $data = [
            'racion_id'=>$x->get_racion_id(),
            'fecha'=>'2020-5-21',
            'horario_id'=>$x->get_horario_id(),
            'stock_original'=>10,
            /*'cantidad_restante'=>10,
            'cantidad_realizados'=>0,*/
        ];
        $rd = new RacionesDisponibles($data);
        $rd->save();
      };

    }

}
