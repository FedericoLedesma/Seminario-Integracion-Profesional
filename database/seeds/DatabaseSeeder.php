<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	DB::table('users')->insert([
    			'dni' => '1234',
    			'name'=>'admin',
    			'password'=>bcrypt('12345678'),

    	]);
    	DB::table('roles')->insert([
    			'name' => 'Administrador',
    			'guard_name'=>'web',
    	]);

    	DB::table('permissions')->insert([
    			'name' => 'alta_usuarios',
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
          'name' => 'alta_permisos',
          'guard_name'=>'web',
      ]);
      DB::table('permissions')->insert([
          'name' => 'baja_permisos',
          'guard_name'=>'web',
      ]);
      DB::table('permissions')->insert([
          'name' => 'modificacion_permisos',
          'guard_name'=>'web',
      ]);


    }
}
