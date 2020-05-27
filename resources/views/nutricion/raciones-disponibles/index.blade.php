@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Raciones Disponibles</li>
@endsection
@section('content')


	    <h1>Raciones Disponibles registradas</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<form method="get" action={{ route('raciones-disponibles.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Disponibilidad</button>


</form>
<div>
	<p>
		<span id="personas-total">
			<!-- Aca deben ir el total de racioenes -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-raciones" class="alert alert-info">Raciones con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>
<div class="container">

	<div class="table-responsive">
  	<div class="col-md-9 col-md-offset-1">

 <div class="panel-heading">
				 {!!Form::open(['route'=>'raciones-disponibles.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">
					 <table class="table table-striped table-hover ">
						 <thead>
						 		<tr>
									<th scope="col">Fecha</th>
									<th scope="col">Horarios</th>
									<th scope="col">Id Racion</th>
									<th scope="col"></th>

								</tr>

						 </thead>
						 <tbody>
							 <tr>
								 <td>{!!Form::date('fecha', \Carbon\Carbon::now(),['id'=>'fecha']);!!}</td>
								 <td>

									 <select class="browser-default custom-select" id="busqueda_horario_por" name="busqueda_horario_por">
									 	<option value="busqueda_todos" >Todos</option>
									 	 @if($horarios)
											@foreach($horarios as $horario)
											<option value="{{$horario->id}}" >{{$horario->name}}</option>
											@endforeach
										@endif
										</select>
									</td>

								 <td>
										{!!	Form::number('racionid',null,['id'=>'racionesid','class'=>'form-control','name'=>'search','min'=>'0','placeholder'=>'Ingrese el id'])!!}
								 </td>
								 <td>
									 {!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
								 </td>
							 </tr>

						 </tbody>
					 </table>
					 </div>
					{!! Form::close() !!}

					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">Racion</th>
								<th scope="col">Horario</th>
								<th scope="col">Fecha</th>
								<th scope="col">Cantidad</th>
								<th scope="col">Accion</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($racionesDisponibles)
							@foreach($racionesDisponibles as $racionDisponible)
							<tr>
								<td>{{$racionDisponible->horario_racion->racion->name}}</td>
								<td>{{$racionDisponible->horario_racion->horario->name}}</td>
								<td>{{$racionDisponible->fecha()}}</td>
								<td>{{$racionDisponible->cantidad_restante}}</td>

								<td>

								{!!Form::open(array('route'=>['raciones-disponibles.show',$racionDisponible->id],'method'=>'GET'))!!}
								{!!Form::button('ver',['class'=>'btn btn-primary','type'=>'submit'])!!}
									{!! Form::close() !!}
								</td>

								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $racionDisponible }}">Eliminar</button></td>


							</tr>
								@endforeach
							@endif

					</table>
			</div>
		</div>
	</div>
</div>


@endsection
@section('script')
 <script src="{{asset('js/racion-disponibles-script.js')}}"></script>
@endsection
