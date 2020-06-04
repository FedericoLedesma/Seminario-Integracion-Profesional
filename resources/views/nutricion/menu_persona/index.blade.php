@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Planillas</li>
@endsection
@section('content')

<!-- INDEX DEL ROL -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	  	<title>Menu persona</title>

	    <h1>Menus de persona (planillas) existentes</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<container justify-content="space-evenly">
	<a href="{{action('MenuPersonaController@create')}}" class="btn btn-primary">Agregar menu persona (planilla)</a>

	<a href="{{action('InformeController@index')}}" class="btn btn-primary">Informes</a>

</container>
<div>
	<p>
		<span id="menu_persona-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-menu_persona" class="alert alert-info">Menues persona (Planillas) con {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
  <div class="table-responsive">
		<div class="col-md-11 col-md-offset-1">
			<div class="panel-heading">
				{!!Form::open(['route'=>'menu_persona.index','method'=>'GET']) !!}
				<div class="input-group mb-3">
					<table class="table table-striped table-hover ">
						<thead>
							<tr>
								<th scope="col">Fecha</th>
								<th scope="col">Tipo Persona</th>
								<th scope="col">Horarios  </th>
								<th scope="col">Nombre Sector</th>
								<th scope="col">N. habitacion</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{!!Form::date('fecha', \Carbon\Carbon::now(),['id'=>'fecha']);!!}</td>
								<td>
								<select class="browser-default custom-select" id="busqueda_persona_por" name="busqueda_persona_por">
									<option value="busqueda_todos" >Todos</option>
									<option value="busqueda_pacientes">Pacientes</option>
									<option value="busqueda_personal">Personal</option>
								</select>
								</td>
								<td>
								<select class="browser-default custom-select" id="busqueda_horario_por" name="busqueda_horario_por">
									<option value="0" >Todos</option>
									@if($horarios)
										@foreach($horarios as $horario)
											<option value="{{$horario->id}}" >{{$horario->name}}</option>
										@endforeach
									@endif
								</select>
								</td>
								<td>
									{!!	Form::text('sector_name',null,['id'=>'sector_name','class'=>'form-control','name'=>'search','placeholder'=>'Todos los sectores'])!!}
								</td>
								<td>
									{!!	Form::number('habitacion_id',null,['id'=>'habitacion_id','class'=>'form-control','name'=>'search_habitacion'])!!}
								</td>
								<td>
									{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
								</td>
							</tr>

							<tr>

							</tr>
							<tr>

							</tr>
						</tbody>
					</table>
				</div>
				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	<div class="container">
	  <div class="table-responsive">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel-heading">
					<table class="table table-striped table-hover ">
						<thead >
							<tr>
								<th scope="col">Persona</th>
								<th scope="col">Horario</th>
								<th scope="col">Racion</th>
								<th scope="col">Fecha</th>
								<th scope="col">Realizado</th>
								<th scope="col">Accion</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($menus)
							@foreach($menus as $menu_persona)
							<tr>
								{{Log::debug(' Persona id: '.$menu_persona)}}
								<td>{{$menu_persona->get_persona_nombre_completo()}}</td>
								<td>{{$menu_persona->get_horario_name()}}</td>
								<td>{{$menu_persona->get_racion_name()}}</td>
								<td>{{$menu_persona->racionDisponible->fecha}}</td>
								<td>{{$menu_persona->isRealizado_str()}}</td>
								<td><button type="submit" class="btn btn-success entregar" data-token="{{ csrf_token() }}" data-id="{{ $menu_persona }}">Entregar</button></td>
								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $menu_persona }}">Eliminar</button></td>


							{!! Form::close() !!}
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
 <script src="{{asset('js/menu_persona-script.js')}}"></script>

@endsection
