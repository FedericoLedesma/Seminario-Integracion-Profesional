<head>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

</head>

@extends('layouts.layout')
@section('navegacion')
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

<h1>Informe (planilla)</h1>

			@include('layouts.error')
			<table class="table table-striped table-hover ">
				<thead >
					<tr>
						<th scope="col">Racion</th>
						<th scope="col">Cantidad</th>
						<th scope="col">Realizado</th>
						<th scope="col">Marcar como realizado</th>

					</tr>
				</thead>
				<tbody>
				{{Log::debug('Antes del foreach ')}}
					@foreach($lista as $x)
					<tr>
						<td>{{$x->get_racion_name()}}</td>
						<td>{{$x->get_cantidad()}}</td>
						<td>
							@if($x->is_realizado())
								preparado
							@else
								no preparado
							@endif
						</td>
						<td>
							<a href="{{action('InformeController@set_realizado', [
								'json'=>json_encode($x->getJsonData()),
								'realizado'=>true,
								'fecha_inicio'=>$fecha_inicio,
								'horario_inicio'=>$horario_inicio,
								'fecha_fin'=>$fecha_fin,
								'horario_fin'=>$horario_fin
							])}}" class="btn btn-primary">Ya realizado</a>
							<a href="{{action('InformeController@set_realizado', [
								'json'=>json_encode($x->getJsonData()),
								'realizado'=>false,
								'fecha_inicio'=>$fecha_inicio,
								'horario_inicio'=>$horario_inicio,
								'fecha_fin'=>$fecha_fin,
								'horario_fin'=>$horario_fin
							])}}" class="btn btn-primary">No realizado</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>


			{!!Form::open(['route'=>'InformeController.create','method'=>'GET']) !!}
				<div class="input-group mb-3">

				<input class="date form-control" type="text" id="fecha_inicio" name="fecha_inicio" value={{$fecha_inicio}}>
				<script type="text/javascript" id="calendario_" name="calendario_">
					var new_date = $('.date').datepicker({format: 'yyyy-mm-dd'});
				</script>

				<select class="browser-default custom-select" id="horario_inicio" name="horario_inicio">
					@foreach($horarios as $horario)
					<option value={{$horario->id}} > {{$horario->name}}</option>
					@endforeach
				</select>

				<input class="date form-control" type="text" id="fecha_fin" name="fecha_fin"  value={{$fecha_fin}}>
				<script type="text/javascript" id="calendario_" name="calendario_">
					var new_date = $('.date').datepicker({format: 'yyyy-mm-dd'});
				</script>

				<select class="browser-default custom-select" id="horario_fin" name="horario_fin">
					@foreach($horarios as $horario)
					<option value={{$horario->id}} > {{$horario->name}}</option>
					@endforeach
				</select>

				</div>

			 {!!	Form::submit('Generar otro informe',['class'=>'btn btn-success btn-buscar'])!!}
			 {!! Form::close() !!}


@endsection
