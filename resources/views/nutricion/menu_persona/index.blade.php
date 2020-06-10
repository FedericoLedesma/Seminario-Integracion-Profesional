@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.table{
	 background-color: #E3EEE9;

</style>
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


<container justify-content="space-evenly">
	<a href="{{action('MenuPersonaController@create')}}" class="btn btn-primary">Agregar menu a Pacientes (planilla)</a>
	<a href="{{route('menu_persona.create_personal')}}" class="btn btn-primary">Agregar menu Personal (planilla)</a>
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
		<div id="alert" name="alert-raciones" class="alert alert-info">Menus por: {{$busqueda_por}} {{$query}}</div>
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
			<div class="col-md-11 col-md-offset-2">
				<div class="panel-heading">
					<table class="table table-striped table-hover ">
						<thead >
							<tr>
								<th scope="col">Persona</th>
								<th scope="col">Sector </th>
	              <th scope="col">Habitacion</th>
	              <th scope="col">Cama</th>
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
								@if($menu_persona->persona->sectorFecha($menu_persona->racionDisponible->fecha))
	                <td>{{$menu_persona->persona->sectorFecha($menu_persona->racionDisponible->fecha)->name}}</td>
	              @else
	                <td>-</td>
	              @endif
	              @if($menu_persona->persona->habitacionFecha($menu_persona->racionDisponible->fecha))
	                <td>{{$menu_persona->persona->habitacionFecha($menu_persona->racionDisponible->fecha)->name}}</td>
								@else
	                <td>-</td>
								@endif
								@if($menu_persona->persona->camaFecha($menu_persona->racionDisponible->fecha))
	                <td>{{$menu_persona->persona->camaFecha($menu_persona->racionDisponible->fecha)->id}}</td>
	              @else
	                <td>-</td>
	              @endif
								<td>{{$menu_persona->get_horario_name()}}</td>
								<td>{{$menu_persona->get_racion_name()}}</td>
								<td>{{$menu_persona->racionDisponible->fecha()}}</td>
								<td>{{$menu_persona->isRealizado_str()}}</td>
								@if($menu_persona->realizado)
								<td><button type="submit" class="btn btn-success entregar"  disabled>Entregar</button></td>
								<td><button type="submit" class="btn btn-danger eliminar" disabled>Eliminar</button></td>
								@else
								<td><button type="submit" class="btn btn-success entregar" id="btn-{{$menu_persona->id}}" data-token="{{ csrf_token() }}" data-id="{{ $menu_persona }}">Entregar</button></td>
								<td><button type="submit" class="btn btn-danger eliminar" id="btn-eliminar-{{$menu_persona->id}}" data-token="{{ csrf_token() }}" data-id="{{ $menu_persona }}">Eliminar</button></td>
								@endif

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
