<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Persona;
use App\Personal;
use App\TipoDocumento;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use App\Racion;
use App\Alimento;
use App\Horario;
use App\Paciente;
use App\Acompanante;
use App\Sector;
use App\Cama;
use App\PacienteCama;
use App\Habitacion;
use App\HorarioRacion;
use App\RacionesDisponibles;
use App\Unidad;
use Illuminate\Support\Facades\Log;
use App\HistoriaInternacion;
#use Database\Menu_personaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $tipo_doc=TipoDocumento::create([
        'name'=>'DNI',
      ]);
      $persona = Persona::create([
          #'id'=>1,
          'name'=>'FEDERICO',
          'apellido'=>'ADMIN',
          'tipo_documento_id'=>$tipo_doc->id,
          'numero_doc'=>40000000,
          'direccion'=>'LAVALLE 1506',
          'email'=>'admin@seminario.com',
          'provincia'=>'BUENOS AIRES',
          'localidad'=>'GENERAL RODRIGUEZ',
          'sexo'=>'MASCULINO',
          'fecha_nac'=>'1997-02-02'
      ]);
      $personal=Personal::create([
        'id'=>$persona->id,
      ]);
        // $this->call(UsersTableSeeder::class);
    	DB::table('users')->insert([
    			'dni' => '40000000',
    			'name'=>'ADMIN',
				   'personal_id'=>1,
    			'password'=>bcrypt('12345678'),

    	]);
    	DB::table('roles')->insert([
    			'name' => 'Super-User',
    			'guard_name'=>'web',
    	]);

      $acciones = ['alta','baja','modificacion','ver'];
      $tablas = ['usuarios','roles','patologias','permisos','personas','raciones','alimentos',
      'tipos-patologias','raciones-disponibles','sectores','historial','menu','camas',
      'profesion','personal'];

      foreach ($acciones as $accion) {
        foreach ($tablas as $tabla) {
          Permission::create([
        			'name' => $accion.'_'.$tabla,
        			'guard_name'=>'web',
        	]);
        }
      }
      //--------Tipos de Movimientos----------------------
      DB::table('tipo_movimiento')->insert([
          'name' => 'Agregar al stock',
      ]);
      DB::table('tipo_movimiento')->insert([
          'name' => 'Entregar racion (descontar)',
      ]);
  	  $user=User::find('1');
  	  $role=Role::create(['name'=>'Administrador']);
  	  $permisos=Permission::all();
  	  foreach($permisos as $permiso){
  		  $role->givePermissionTo($permiso);
  	  }
  	  $user->assignRole('Administrador');
/*
		$this->call([
			Menu_personaSeeder::class
		]);*/

    static::cargar_menu_persona();

	}

  /*public static function cargar_admin_y_permisos(){
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
  }*/
  private static function cargar_raciones_ali(){
    $r1 = Racion::create([
      'name'=>'CHURRASCO CON FIDEOS',
    ]);

    $r2 = Racion::create([
      'name'=>'MILANESA CON PURE DE PAPAS',
    ]);

    $r3 = Racion::create([
      'name'=>'PIZZA DE CEBOLLA',
    ]);

    $r4 = Racion::create([
      'name'=>'TÉ CON GALLETITAS DE AGUA',
    ]);

    $r5 = Racion::create([
      'name'=>'GELATINA DE FRUTILLA',
    ]);

    $r6 = Racion::create([
      'name'=>'SOPA',
    ]);

    $a1 = Alimento::create([
      'name'=>'LECHUGA'
    ]);

    $a2 = Alimento::create([
      'name'=>'CARNE DE VACA'
    ]);

    $a3 = Alimento::create([
      'name'=>'GALLETITAS DE AGUA'
    ]);

    $a4 = Alimento::create([
      'name'=>'CEBOLLA'
    ]);

    $a5 = Alimento::create([
      'name'=>'FIDEOS'
    ]);

    $a6 = Alimento::create([
      'name'=>'MERMELADA'
    ]);
    $u= Unidad::create([
      'name'=>'Kilogramos'
    ]);
    $u2= Unidad::create([
      'name'=>'Gramos'
    ]);
    $u3= Unidad::create([
      'name'=>'Litros'
    ]);
    $r1->add_alimento($a2,100,$u2->id);
    $r1->add_alimento($a5,100,$u2->id);
    $r2->add_alimento($a2,200,$u2->id);
    $r3->add_alimento($a4,200,$u2->id);
    $r4->add_alimento($a3,200,$u2->id);
    $r5->add_alimento($a3,200,$u2->id);
    $r5->add_alimento($a6,200,$u2->id);
    $r6->add_alimento($a1,200,$u2->id);
    $r6->add_alimento($a4,200,$u2->id);

  }

  private static function cargar_horarios(){
    $data = [
      'name'=>'Desayuno'
    ];
    $h1 = new Horario($data);
    $h1->save();
    $data = [
      'name'=>'Colación'
    ];
    $h2 = new Horario($data);
    $h2->save();
    $data = [
      'name'=>'Almuerzo'
    ];
    $h3 = new Horario($data);
    $h3->save();
    $data = [
      'name'=>'Merienda'
    ];
    $h4 = new Horario($data);
    $h4->save();
    $data = [
      'name'=>'Cena'
    ];
    $h5 = new Horario($data);
    $h5->save();
  }

  private static function cargar_tipo_documentos(){

    $data =[
      'name'=>'Libreta Cívica'
    ];
    $t2 = new TipoDocumento($data);
    $t2->save();
    $data =[
      'name'=>'Indocumentado'
    ];
    $t3 = new TipoDocumento($data);
    $t3->save();
    $data =[
      'name'=>'Pasaporte'
    ];
    $t4 = new TipoDocumento($data);
    $t4->save();
    $data =[
      'name'=>'Libreta Enrolamiento'
    ];
    $t5 = new TipoDocumento($data);
    $t5->save();
    $data =[
      'name'=>'CUIL'
    ];
    $t6 = new TipoDocumento($data);
    $t6->save();
    $data =[
      'name'=>'CI Extranjeros'
    ];
    $t7 = new TipoDocumento($data);
    $t7->save();
  }

  private static function cargar_personas(){
    static::cargar_tipo_documentos();
    $data = [
      'numero_doc'=>31241573,
      'apellido'=>'AGUIRRE',
      'name'=>'ANDRES',
      'observacion'=>'OK',
      'direccion'=>'INDEPENDENCIA 601',
      'email'=>'andres@test.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'MORENO',
      'sexo'=>'MASCULINO',
      'fecha_nac'=>'1960-5-5',
      'tipo_documento_id'=>1,
    ];
    $p1 = new Persona($data);
    $p1->save();
    $data = [
      'numero_doc'=>34154498,
      'apellido'=>'ARBO',
      'name'=>'CECILIA',
      'observacion'=>'OK',
      'direccion'=>'RIVADAVIA 36001',
      'email'=>'lopez.juan@test.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'1800-1-1',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1960-2-8',
      'tipo_documento_id'=>1,
    ];
    $p2 = new Persona($data);
    $p2->save();
    $data = [
      'numero_doc'=>16582895,
      'apellido'=>'ARDUINO',
      'name'=>'MARIO EUGENIO',
      'observacion'=>'OK',
      'direccion'=>'BALCARCE 606',
      'email'=>'arduinoma@test.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'MERLO',
      'sexo'=>'MASCULINO',
      'fecha_nac'=>'1985-2-2',
      'tipo_documento_id'=>1,
    ];
    $p3 = new Persona($data);
    $p3->save();
    $data = [
      'numero_doc'=>22576032,
      'apellido'=>'BAIONI',
      'name'=>'GABRIELA ROBERTA',
      'observacion'=>'OK',
      'direccion'=>'LIBERTAD 2548',
      'email'=>'carla@test.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'LUJÁN',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1989-5-5',
      'tipo_documento_id'=>1,
    ];
    $p4 = new Persona($data);
    $p4->save();
    $data = [
      'numero_doc'=>13214174,
      'apellido'=>'FERNANDEZ',
      'name'=>'MARIA',
      'observacion'=>'OK',
      'direccion'=>'CALLE 14 N°.355',
      'email'=>'-',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'SAN ANDRÉS DE GILES',
      'sexo'=>'femenino',
      'fecha_nac'=>'1979-2-15',
      'tipo_documento_id'=>1,
    ];
    $p5 = new Persona($data);
    $p5->save();
    $data = [
      'numero_doc'=>24618959,
      'apellido'=>'BARCOS',
      'name'=>'PEDRO',
      'observacion'=>'OK',
      'direccion'=>'-',
      'email'=>'-',
      'provincia'=>'-',
      'localidad'=>'-',
      'sexo'=>'MASCULINO',
      'fecha_nac'=>'1965-11-8',
      'tipo_documento_id'=>1,
    ];
    $p6 = new Persona($data);
    $p6->save();
    $data = [
      'numero_doc'=>12566554,
      'apellido'=>'BENITEZ',
      'name'=>'VERONICA',
      'observacion'=>'-',
      'direccion'=>'JUAN MANUEL DE ROSAS 456',
      'email'=>'veronica@gmail.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'LUJÁN',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1995-12-12',
      'tipo_documento_id'=>3,
    ];
    $p7 = new Persona($data);
    $p7->save();
    $data = [
      'numero_doc'=>95531632,
      'apellido'=>'BERGE',
      'name'=>'PAMELA',
      'observacion'=>'OK',
      'direccion'=>'LA PINTA 287',
      'email'=>'pamela@yahoo.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'MORON',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1990-5-5',
      'tipo_documento_id'=>1,
    ];
    $p8 = new Persona($data);
    $p8->save();
    $data = [
      'numero_doc'=>12647194,
      'apellido'=>'OLIVERTI',
      'name'=>'RICARDO',
      'observacion'=>'OK',
      'direccion'=>'PUEYRREDON 600',
      'email'=>'oliverti@test.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'JAUREGUI',
      'sexo'=>'MASCULINO',
      'fecha_nac'=>'1990-5-5',
      'tipo_documento_id'=>1,
    ];
    $p9 = new Persona($data);
    $p9->save();
    $data = [
      'numero_doc'=>19325205,
      'apellido'=>'GOMEZ',
      'name'=>'FABIAN',
      'observacion'=>'OK',
      'direccion'=>'SAN MARTIN 1245',
      'email'=>'fabian@yahoo.com.ar',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'MORENO',
      'sexo'=>'MASCULINO',
      'fecha_nac'=>'1989-7-2',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>16809531,
      'apellido'=>'BENITEZ',
      'name'=>'CARLOS',
      'observacion'=>'OK',
      'direccion'=>'EL FACÓN 1245',
      'email'=>'benitezzz@yahoo.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'GENERAL RODRIGUEZ',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1977-7-27',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>17448901,
      'apellido'=>'MALLO',
      'name'=>'MARCOS AGUSTIN',
      'observacion'=>'OK',
      'direccion'=>'EL AMANECER 145',
      'email'=>'malloyo@yahoo.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'GENERAL RODRIGUEZ',
      'sexo'=>'MASCULINO',
      'fecha_nac'=>'1987-7-25',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>20987908,
      'apellido'=>'PIGHIN',
      'name'=>'NELIDA CLARA',
      'observacion'=>'OK',
      'direccion'=>'EL PERICÓN 4564',
      'email'=>'nelidacp@yahoo.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'MARCOS PAZ',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1998-5-27',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>21040557,
      'apellido'=>'PEREZ',
      'name'=>'JULIO ANDRES',
      'observacion'=>'OK',
      'direccion'=>'CARLOS PELLEGRINI 198',
      'email'=>'perezjulio@gmail.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'MORENO',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1980-10-5',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>21399214,
      'apellido'=>'MASSA',
      'name'=>'DOLORES GUADALUPE',
      'observacion'=>'OK',
      'direccion'=>'AGÜERO 457',
      'email'=>'massaaguero@yahoo.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'MORENO',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1979-9-13',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>17448901,
      'apellido'=>'MENSEGUEZ',
      'name'=>'LUCIA LAURA',
      'observacion'=>'OK',
      'direccion'=>'JOSE C. PAZ 544',
      'email'=>'menseguez12@yahoo.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'GENERAL RODRIGUEZ',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1989-9-7',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>17448901,
      'apellido'=>'BRANDAN',
      'name'=>'CELIA',
      'observacion'=>'OK',
      'direccion'=>'PIEDAS 1245',
      'email'=>'brandancelia@yahoo.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'GENERAL RODRIGUEZ',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1977-7-27',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>16821037,
      'apellido'=>'BRASILI',
      'name'=>'FERNANDO',
      'observacion'=>'OK',
      'direccion'=>'VIDT 1245',
      'email'=>'brasili@yahoo.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'LOBOS',
      'sexo'=>'MASCULINO',
      'fecha_nac'=>'1978-7-17',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>13285797,
      'apellido'=>'BRUNO',
      'name'=>'SEBASTIAN LEANDRO',
      'observacion'=>'OK',
      'direccion'=>'PINCIROLLI 4578',
      'email'=>'bruno@gmail.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'GENERAL RODRIGUEZ',
      'sexo'=>'MASCULINO',
      'fecha_nac'=>'1997-7-27',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>27033530,
      'apellido'=>'VALERO',
      'name'=>'CESAR JOSUÉ',
      'observacion'=>'OK',
      'direccion'=>'SARMIENTO 9852',
      'email'=>'sarmiento@hotmail.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'GENERAL RODRIGUEZ',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1992-2-15',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>18860528,
      'apellido'=>'TELIAS',
      'name'=>'ESTEBAN HERNAN',
      'observacion'=>'OK',
      'direccion'=>'ALMIRANTE BROWN 192',
      'email'=>'hernan@hotmail.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'MARCOS PAZ',
      'sexo'=>'MASCULINO',
      'fecha_nac'=>'1991-2-19',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>24834180,
      'apellido'=>'TORRES',
      'name'=>'MARIA JOSE',
      'observacion'=>'OK',
      'direccion'=>'CONSTITUCIÓN 1233',
      'email'=>'torresmj@hotmail.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'MARCOS PAZ',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1996-2-15',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>26725275,
      'apellido'=>'SOTELO',
      'name'=>'NATALIA MARIA',
      'observacion'=>'OK',
      'direccion'=>'AVELLANEDA 1230',
      'email'=>'soteloa@yahoo.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'GENERAL RODRIGUEZ',
      'sexo'=>'FEMENINO',
      'fecha_nac'=>'1994-8-2',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>14490519,
      'apellido'=>'TOLEDO',
      'name'=>'MARCOS GABRIEL',
      'observacion'=>'OK',
      'direccion'=>'EL MATE 2154',
      'email'=>'toledomg@hotmail.com',
      'provincia'=>'BUENOS AIRES',
      'localidad'=>'MERLO',
      'sexo'=>'MASCULINO',
      'fecha_nac'=>'1985-2-2',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
  }

  private static function cargar_personal_y_pacientes(){
    static::cargar_personas();
    /*$data = [
      'id'=>1,
      'matricula'=>11111111
    ];
    $p1 = new Personal($data);
    $p1->save();*/
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
    $data = [
      'id'=>5
    ];
    $p5 = new Paciente($data);
    $p5->save();
    $data = [
      'id'=>6
    ];
    $p6 = new Paciente($data);
    $p6->save();
    $data = [
      'id'=>7
    ];
    $p7 = new Paciente($data);
    $p7->save();
    $data = [
      'id'=>8
    ];
    $p8 = new Paciente($data);
    $p8->save();
    $data = [
      'id'=>9
    ];
    $p9 = new Paciente($data);
    $p9->save();
    $data = [
      'id'=>10
    ];
    $p10= new Paciente($data);
    $p10->save();
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
    $menu_raciones = HorarioRacion::all();
    foreach ($menu_raciones as $x) {
      // code...
      Log::debug('Método cargar raciones disponibles: se encontró un horario racion: '.$x);
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>'2020-5-21',
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];

      //Raciones para el 20
      $rd = new RacionesDisponibles($data);
      $rd->save();
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>'2020-5-20',
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 19
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>'2020-5-19',
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 18
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>'2020-5-18',
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 17
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>'2020-5-17',
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 16
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>'2020-5-16',
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 15
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>'2020-5-15',
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 14
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>'2020-5-14',
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();
    };

  }

  public static function cargar_menu_persona(){
    static::cargar_personal_y_pacientes();
    static::cargar_raciones_disponibles();
    $data = [
      'paciente_id'=>5,
      'fecha_ingreso'=>'2020-1-1',
      'peso'=>70,
      'fecha_egreso'=>null,
    ];
    $h1 = new HistoriaInternacion($data);
    $h1->save();
    $data = [
      'paciente_id'=>6,
      'fecha_ingreso'=>'2020-1-1',
      'peso'=>70,
      'fecha_egreso'=>null,
    ];
    $h2 = new HistoriaInternacion($data);
    $h2->save();
    $data = [
      'paciente_id'=>7,
      'fecha_ingreso'=>'2020-1-1',
      'peso'=>80,
      'fecha_egreso'=>null,
    ];
    $h3 = new HistoriaInternacion($data);
    $h3->save();
    $data = [
      'paciente_id'=>8,
      'fecha_ingreso'=>'2020-5-1',
      'peso'=>70,
      'fecha_egreso'=>null,
    ];
    $h4 = new HistoriaInternacion($data);
    $h4->save();
    $data = [
      'paciente_id'=>9,
      'fecha_ingreso'=>'2020-5-10',
      'peso'=>70,
      'fecha_egreso'=>null,
    ];
    $h5 = new HistoriaInternacion($data);
    $h5->save();
    $data = [
      'paciente_id'=>10,
      'fecha_ingreso'=>'2020-5-10',
      'peso'=>70,
      'fecha_egreso'=>null,
    ];
    $h6 = new HistoriaInternacion($data);
    $h6->save();



    $data= [
      'name'=>'Sector 1',
      'descripcion'=>'-',
    ];
    $s1= new Sector($data);
    $s1->save();
    $data= [
      'name'=>'Sector 2',
      'descripcion'=>'-',
    ];
    $s2= new Sector($data);
    $s2->save();
    $data= [
      'name'=>'Sector 3',
      'descripcion'=>'-',
    ];
    $s3= new Sector($data);
    $s3->save();
    $data= [
      'name'=>'Sector 4',
      'descripcion'=>'-',
    ];
    $s4= new Sector($data);
    $s4->save();

    $data= [
      'sector_id'=>$s1->id,
      'name'=>'h1',
      'descripcion'=>'-',
    ];
    //--------habitacion 1 sector 1--------------------------
    $h1= new Habitacion($data);
    $h1->save();
    $data= [
      'sector_id'=>$s1->id,
      'name'=>'h2',
      'descripcion'=>'-',
    ];
    $h2= new Habitacion($data);
    $h2->save();
    $data= [
      'sector_id'=>$s1->id,
      'name'=>'h3',
      'descripcion'=>'-',
    ];
    $h3= new Habitacion($data);
    $h3->save();
    $data= [
      'sector_id'=>$s1->id,
      'name'=>'h4',
      'descripcion'=>'-',
    ];
    $h4= new Habitacion($data);
    $h4->save();
    //------------habitacion 2 sector 2------------------
    $data= [
      'sector_id'=>$s2->id,
      'name'=>'h2s1',
      'descripcion'=>'-',
    ];
    $h1s2= new Habitacion($data);
    $h1s2->save();
    $data= [
      'sector_id'=>$s2->id,
      'name'=>'h2s2',
      'descripcion'=>'-',
    ];
    $h2s2= new Habitacion($data);
    $h2s2->save();
    $data= [
      'sector_id'=>$s2->id,
      'name'=>'h3s3',
      'descripcion'=>'-',
    ];
    $h2s2= new Habitacion($data);
    $h2s2->save();
    //--------camas----habitacion 1 sector 1--------------------------
    $data=[
      'habitacion_id'=>$h1->id,
    ];
    $cama1= new Cama($data);
    $cama1->save();
    $data=[
      'habitacion_id'=>$h1->id,
    ];
    $cama2= new Cama($data);
    $cama2->save();
    $data=[
      'habitacion_id'=>$h1->id,
    ];
    $cama3= new Cama($data);
    $cama3->save();
    //-------camas habitacion 2 sector 1---------
    $data=[
      'habitacion_id'=>$h2->id,
    ];
    $cama1h2s1= new Cama($data);
    $cama1h2s1->save();
    $data=[
      'habitacion_id'=>$h2->id,
    ];
    $cama2h2s1= new Cama($data);
    $cama2h2s1->save();
    $data=[
      'habitacion_id'=>$h2->id,
    ];
    $cama3h2s1= new Cama($data);
    $cama3h2s1->save();
    $data=[
      'habitacion_id'=>$h2->id,
    ];
    $cama4h2s1= new Cama($data);
    $cama4h2s1->save();
    //----------camas habitacion1 sector 2------
    $data=[
      'habitacion_id'=>$h1s2->id,
    ];
    $cama1h1s2= new Cama($data);
    $cama1h1s2->save();
    $data=[
      'habitacion_id'=>$h1s2->id,
    ];
    $cama2h1s2= new Cama($data);
    $cama2h1s2->save();
    $data=[
      'habitacion_id'=>$h1s2->id,
    ];
    $cama3h1s2= new Cama($data);
    $cama3h1s2->save();
    $data=[
      'habitacion_id'=>$h1s2->id,
    ];
    $cama4h1s2= new Cama($data);
    $cama4h1s2->save();
    //-----------pacientes camas--------------
    $data=[
      'paciente_id'=>5,
      'cama_id'=>$cama1->id,
      'fecha'=>'2020-02-02'
    ];
    $paci_cama= new PacienteCama($data);
    $paci_cama->save();
    $data=[
      'paciente_id'=>6,
      'cama_id'=>$cama2->id,
      'fecha'=>'2020-02-02'
    ];
    $paci2_cama= new PacienteCama($data);
    $paci2_cama->save();
    $data=[
      'paciente_id'=>7,
      'cama_id'=>$cama3->id,
      'fecha'=>'2020-02-02'
    ];
    $paci1_cama= new PacienteCama($data);
    $paci1_cama->save();
    $data=[
      'paciente_id'=>8,
      'cama_id'=>$cama1h1s2->id,
      'fecha'=>'2020-02-02'
    ];
    $paci3_cama= new PacienteCama($data);
    $paci3_cama->save();
    $data=[
      'paciente_id'=>9,
      'cama_id'=>$cama2h1s2->id,
      'fecha'=>'2020-02-02'
    ];
    $paci4_cama= new PacienteCama($data);
    $paci4_cama->save();
    $data=[
      'paciente_id'=>10,
      'cama_id'=>$cama3h1s2->id,
      'fecha'=>'2020-02-02'
    ];
    $paci5_cama= new PacienteCama($data);
    $paci5_cama->save();


  }
}
