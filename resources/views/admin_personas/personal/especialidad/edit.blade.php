@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('especialidad.index') }}">Especialidades</a></li>
		<li class="breadcrumb-item active">Editar especialidad</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($especialidad, ['route' => ['especialidad.update', $especialidad->id], 'method'=> 'PUT'])!!}
	 	@if($especialidad)
	    <h1>Editar habitación:  {{$especialidad->name}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
        <tr>
	    		<td>ID </td>
				<td>{{$especialidad->id}}</td>
  			</tr>
        <tr>
  				<td>Nombre </td>
  				<td>{!!	Form::text('name',$especialidad->name)!!}</td>
  			</tr>
        <tr>
  				<td>Profesion </td>
  				<td><select id='profesion_id' name='profesion_id'>
              @foreach($profesiones as $profesion)
                  <option value={{$profesion->get_id()}}>{{$profesion->get_name()}}</option>
              @endforeach
          </select></td>
  			</tr>
		   	<tr>
  		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
  		    </td>
        </tr>
        <tr>
		    <td>
		   	{!!link_to_route('especialidad.show', $title = 'CANCELAR', $parameters = [$especialidad->id], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif

		</div>
		</div>
@endsection
