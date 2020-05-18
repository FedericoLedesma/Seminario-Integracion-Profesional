<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
</head>


@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('roles.index') }}">Roles</a></li>
		<li class="breadcrumb-item active">Crear Rol</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

<h1>Agregar menu persona (planilla)</h1>

	{!!Form::open(['route'=>'menu_persona.create','method'=>'GET']) !!}
		<div class="input-group mb-3">

			<input class="date form-control" type="text" id="calendario" name="calendario">
			<script type="text/javascript" id="calendario_" name="calendario_"> 
				var new_date = $('.date').datepicker({format: 'yyyy-mm-dd'});  
			</script>  

			<select class="browser-default custom-select" id="horario" name="horario">
				@foreach($horarios as $horario)
				<option value= {{$horario->id}} >{{$horario->name}}</option>	
				@endforeach		
			</select>
		<div class="input-group-append">
		{!!	Form::submit('Ir a dia/horario',['class'=>'btn btn-success btn-buscar'])!!}
	{!! Form::close() !!}
	{!!Form::open(['route'=>'menu_persona.store','method'=>'GET']) !!}
		</div>
			</div>
			@include('layouts.error')
			<table>
				<tr>
					<td>
					{!!	Form::label('name', 'Nombre de la persona')!!}
					<select class="browser-default custom-select" id="persona" name="persona">
						<option value='0'> ninguno </option>
						@foreach($pacientes as $paciente)
							<option value= {{$paciente->id}} >{{$paciente->name}} {{$paciente->apellido}}</option>
						@endforeach
					</select>
					</td>					
					<td>
					{!!	Form::label('name', 'Racion')!!}
					<select class="browser-default custom-select" id="racion" name="racion">
						<option value='0'> ninguna </option>
						@foreach($raciones_disponibles as $racion)
							{{Log::debug('Dando vueltas. Racion: '.$racion)}}
							<option value= {{$racion->id}} > {{$racion->name}}</option>
						@endforeach
					</select>
					</td>
					<td>
					{!!	Form::label('name', 'Fecha')!!}
					<select class="browser-default custom-select" id="fecha" name="fecha">
						@if($fecha)
						<option value=$fecha> {{$fecha}} </option>
						@endif
					</select>
					</td>
					<td>
					{!!	Form::label('name', 'Horario')!!}
					<select class="browser-default custom-select" id="horario" name="horario">
						@if($horario)
						<option value= {{$horario->id}}> {{$horario->name}} </option>
						@endif
					</select>
					</td>
				</tr>
				<tr>
					<td>
						{!!	Form::submit('Cargar menu persona (planilla)',['class' => 'btn btn-success'])!!}
					</td>
					<td>
						{!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
					</td>
				</tr>
			</table>
		{!! Form::close() !!}

@endsection
