<?php

namespace Tests\Feature\DataBase;

use App\User;
use App\Racion;
use App\Alimento;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class custom_seeder
{
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

    public static function cargar_raciones_ali(){
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
        'name,50'=>'lechuga'
      ]);

      $a2 = Alimento::create([
        'name,50'=>'carne de vaca'
      ]);

      $a3 = Alimento::create([
        'name,50'=>'galletitas de agua'
      ]);

      $a4 = Alimento::create([
        'name,50'=>'cebolla'
      ]);

      $a5 = Alimento::create([
        'name,50'=>'fideos'
      ]);

      $a6 = Alimento::create([
        'name,50'=>'mermelada'
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

}
