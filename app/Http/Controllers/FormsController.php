<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Habitacion;
use App\Sector;

class FormsController extends Controller
{
    //

    public function showSelect(Request $request, $form, $id){
      Log::Debug('Show select: '.$request);
      if ($form=='habitacion'){
        $habitacion = Habitacion::buscar_por_sector($id);
        return view('forms.selects.'.$form, compact('habitacion'));
      }
      if ($form=='personas'){
        $sector = Sector::findById($id);
        Log::debug('Sector encontrado, buscando los pacientes del sector: '.$sector);
        $crud = $sector->get_pacientes_internados();
        return view('forms.selects.crud_id_name', compact('crud'));
      }
    }
	
	public function showForm(Request $request, $form, $data){
		Log::Debug('Show select: '.$request);
		$formulario = json_decode($form);
		if ($formulario == null)
			return view('forms.error');
		switch ($formulario['type']){
			
			case 'select':
				if ($formulario['form']=='habitacion'){
					$habitacion = Habitacion::buscar_por_sector($id);
					return view('forms.selects.'.$form, compact('habitacion'));
				}
				if ($form=='personas'){
					$sector = Sector::findById($id);
					Log::debug('Sector encontrado, buscando los pacientes del sector: '.$sector);
					$crud = $sector->get_pacientes_internados();
					return view('forms.selects.crud_id_name', compact('crud'));
				}
				break;
			default:
				return view('forms.error');
		}
    }
	
}
