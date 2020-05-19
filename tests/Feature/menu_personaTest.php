<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\User;

class menu_persona extends TestCase
{
    use RefreshDatabase;
    public function test_usuario_logeado_puede_acceder_al_indice(){
      Event::fake();
      DataBase\custom_seeder::cargar_admin_y_permisos();
      $this->actingAs(User::find(1))
        ->get('\menu_persona')
        ->assertOk();
    }
    public function test_usuario_no_logeado_se_redirecciona_al_acceder_al_indice(){
      Event::fake();
      $response = $this->get('\menu_persona')
        ->assertRedirect('\home');
    }

    public function test_cargar_datos(){
      DataBase\custom_seeder::cargar_admin_y_permisos();
      $this->assertGreaterThanOrEqual(1, User::all()->count());
    }
}
