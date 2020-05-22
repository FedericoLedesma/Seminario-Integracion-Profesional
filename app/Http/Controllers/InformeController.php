<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;
use App\Horario;

class InformeController extends Controller
{
    public function index(Request $request)
    {
      #$user = Auth::
      $horarios = Horario::all();
      return view('informe.index',compact('horarios'));
    }

    public function create(Request $request)
    {

      return view('informe.index');
    }
}
