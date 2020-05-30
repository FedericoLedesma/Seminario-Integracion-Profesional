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
        'name'=>'dni',
      ]);
      $persona = Persona::create([
          #'id'=>1,
          'name'=>'pepe',
          'apellido'=>'carlitos',
          'tipo_documento_id'=>$tipo_doc->id,
          'numero_doc'=>1234,
          'direccion'=>'10 n° 100',
          'email'=>'a',
          'provincia'=>'a',
          'localidad'=>' a',
          'sexo'=>'a',
          'fecha_nac'=>Carbon::now()
      ]);
      $personal=Personal::create([
        'id'=>$persona->id,
      ]);
        // $this->call(UsersTableSeeder::class);
    	DB::table('users')->insert([
    			'dni' => '1234',
    			'name'=>'admin',
				'personal_id'=>1,
    			'password'=>bcrypt('12345678'),

    	]);
    	DB::table('roles')->insert([
    			'name' => 'Super-User',
    			'guard_name'=>'web',
    	]);

    	DB::table('permissions')->insert([
    			'name' => 'alta_usuarios',
    			'guard_name'=>'web',
    	]);
      DB::table('permissions')->insert([
          'name' => 'ver_usuarios',
          'guard_name'=>'web',
      ]);

    	DB::table('permissions')->insert([
    			'name' => 'modificacion_usuarios',
    			'guard_name'=>'web',
    	]);
    	DB::table('permissions')->insert([
    			'name' => 'baja_usuarios',
    			'guard_name'=>'web',
    	]);

    	DB::table('permissions')->insert([
    			'name' => 'alta_roles',
    			'guard_name'=>'web',
    	]);
    	DB::table('permissions')->insert([
    			'name' => 'baja_roles',
    			'guard_name'=>'web',
    	]);
    	DB::table('permissions')->insert([
    			'name' => 'modificacion_roles',
    			'guard_name'=>'web',
    	]);
      DB::table('permissions')->insert([
    			'name' => 'ver_roles',
    			'guard_name'=>'web',
    	]);

      DB::table('permissions')->insert([
          'name' => 'alta_permisos',
          'guard_name'=>'web',
      ]);
      DB::table('permissions')->insert([
          'name' => 'baja_permisos',
          'guard_name'=>'web',
      ]);

      DB::table('permissions')->insert([
          'name' => 'ver_permisos',
          'guard_name'=>'web',
	  ]);

	  DB::table('permissions')->insert([
		'name' => 'ver_menu_persona',
		'guard_name'=>'web',
	  ]);

	  DB::table('permissions')->insert([
		'name' => 'modificacion_menu_persona',
		'guard_name'=>'web',
	  ]);

	  DB::table('permissions')->insert([
		'name' => 'alta_menu_persona',
		'guard_name'=>'web',
	  ]);

	  DB::table('permissions')->insert([
		'name' => 'baja_menu_persona',
		'guard_name'=>'web',
	  ]);

    //---------permisos Personas---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_personas',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_personas',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_personas',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_personas',
        'guard_name'=>'web',
    ]);

    //---------permisos alimentos---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_alimentos',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_alimentos',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_alimentos',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_alimentos',
        'guard_name'=>'web',
    ]);
    //---------permisos raciones---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_raciones',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_raciones',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_raciones',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_raciones',
        'guard_name'=>'web',
    ]);
    //---------permisos patologias---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_patologias',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_patologias',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_patologias',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_patologias',
        'guard_name'=>'web',
    ]);
    //---------permisos racionDisponible---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_raciones-disponibles',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_raciones-disponibles',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_raciones-disponibles',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_raciones-disponibles',
        'guard_name'=>'web',
    ]);
    //---------permisos tipos de patologias---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_tipos-patologias',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_tipos-patologias',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_tipos-patologias',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_tipos-patologias',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_tipos-patologias',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'alta_sectores',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_sectores',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'modificacion_sectores',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_sectores',
        'guard_name'=>'web',
    ]);
    //--------Tipos de Movimientos----------------------
    DB::table('tipo_movimiento')->insert([
        'name' => 'Agregar al stock',
    ]);
    DB::table('tipo_movimiento')->insert([
        'name' => 'Entregar racion (descontar)',
    ]);
	  $user=User::find('1');
	  $role=Role::create(['name'=>'Aministrador']);
	  $permisos=Permission::all();
	  foreach($permisos as $permiso){
		  $role->givePermissionTo($permiso);
	  }
	  $user->assignRole('Aministrador');
/*
		$this->call([
			Menu_personaSeeder::class
		]);*/

    static::cargar_menu_persona();

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
      'localidad'=>'1800-1-1',
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
      'fecha_egreso'=>'2020-5-10',
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
      'cama_id'=>$cama1,
      'fecha'=>'2020-02-02'
    ];
    $paci_cama= new PacienteCama($data);
    $paci_cama->save();
    $data=[
      'paciente_id'=>6,
      'cama_id'=>$cama2,
      'fecha'=>'2020-02-02'
    ];
    $paci2_cama= new PacienteCama($data);
    $paci2_cama->save();
    $data=[
      'paciente_id'=>7,
      'cama_id'=>$cama3,
      'fecha'=>'2020-02-02'
    ];
    $paci1_cama= new PacienteCama($data);
    $paci1_cama->save();
    $data=[
      'paciente_id'=>8,
      'cama_id'=>$cama1h1s2,
      'fecha'=>'2020-02-02'
    ];
    $paci3_cama= new PacienteCama($data);
    $paci3_cama->save();
    $data=[
      'paciente_id'=>9,
      'cama_id'=>$cama2h1s2,
      'fecha'=>'2020-02-02'
    ];
    $paci4_cama= new PacienteCama($data);
    $paci4_cama->save();
    $data=[
      'paciente_id'=>10,
      'cama_id'=>$cama3h1s2,
      'fecha'=>'2020-02-02'
    ];
    $paci5_cama= new PacienteCama($data);
    $paci5_cama->save();


  }
}
