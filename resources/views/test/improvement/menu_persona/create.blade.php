<head>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
	<script
				  src="https://code.jquery.com/jquery-3.5.1.js"
				  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
				  crossorigin="anonymous">
	</script>
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

<h1>Recorridos de nutricionista</h1>

	{!!Form::open(['route'=>'menu_persona.create','method'=>'GET']) !!}
		<div class="input-group mb-3">

			<select class="browser-default custom-select" id="sectores" name="sectores">
				<option value='0'> Sector </option>
				@foreach($sector as $s)
					<option value={{$s->id}} >{{$s->name}}</option>
				@endforeach
			</select>
		<div id= "habitaciones">
			<select class="browser-default custom-select" id="habitacion" name="habitacion">
				<option value=0 > Habitación </option>
			</select>
		</div>

			<input class="date form-control" type="text" id="calendario" name="calendario" value={{$fecha}}>


			<select class="browser-default custom-select" id="horario_id" name="horario_id">
				<option value= 0> Todos </option>
				@foreach($horarios as $horario)
				<option value= {{$horario->id}} >{{$horario->name}}</option>
				@endforeach
			</select>
		<div class="input-group-append">
		{!!	Form::submit('Recuperar raciones disponibles',['class'=>'btn btn-success btn-buscar'])!!}

		</div>
			</div>
			@include('layouts.error')
			<table>

					{!!	Form::label('persona_id', 'Persona')!!}
					<div id= "personas">
						<select class="browser-default custom-select" id="persona" name="persona">
							<option value=0 > Persona </option>
						</select>
					</div>
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

@section('script')
<script type="text/javascript">
	$("document").ready(function(){


		$("#sectores").change(function(){
			var token = '{{csrf_token()}}';
			$.ajax({
				type:"get",
				url:	"/forms/select/habitacion/" + $('#sectores').val(),
				success:function(r){
					$('#habitaciones').html(r);
				}
			});
			$.ajax({
				type:"get",
				url:	"/forms/select/personas/" + $('#sectores').val(),
				success:function(r){
					$('#personas').html(r);
				}
			});
		});


	})
</script>
<script type="text/javascript">
	function recargarLista(){
		alert("Select cambiaro");
		var token = '{{csrf_token()}}';
		var pepe ='pepe';
		$.ajax({
			type:"post",
			url:	"/forms/select",
			data:"sector=" + $('#sectores').val(),
			success:function(r){
				$('#habitaciones').html(r);
			}
		}).done(function(  ) {
    alert( 'Termino' );
	}
</script>
@endsection
