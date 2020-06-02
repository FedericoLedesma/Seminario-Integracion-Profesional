@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('historialInternacion.index') }}">Historial pacientes</a></li>
		<li class="breadcrumb-item active">Ingresar paciente</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
      <h1>Ingresar paciente</h1>
        @include('layouts.error')

	    {!!Form::open(['method'=>'post','action'=>'HistorialInternacionController@store'])!!}

	    <div>
        <div>
          <a href="{{action('HistorialInternacionController@createPaciente')}}" class="btn btn-primary">Ingresar a paciente nuevo</a>
        </div>
	    	<div>
  		    {!!	Form::label('name', 'Personas fichadas no internadas')!!}
  		   	<select id='persona_id' name='persona_id' >
              @foreach($personas_no_internadas as $persona)
                <option id= {{$persona->get_id()}}> {{$persona->get_name()}} {{$persona->get_apellido()}} </option>
              @endforeach
          </select>
		   	</div>
		   	<div>
  		    {!!	Form::submit('Ingresar persona fichada',['class' => 'btn btn-success'])!!}
  		   	{!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
		   	</div>
		 </div>
		{!! Form::close() !!}

@endsection
