@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Pacientes</li>
@endsection
@section('content')

<!-- INDEX DEL ROL -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->



	    <h1>Crear Menus</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>

<div>
	<p>
		<span id="users-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>

</div>

<div class="container">
  <div class="table-responsive">
		<div class="col-md-10 col-md-offset-1">

			<div class="panel-heading">
				{!!Form::open(['route'=>'menu_persona.create','method'=>'GET']) !!}
		 			<div class="input-group mb-3">

					  <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
					 		<option value="busqueda_name" >Nombre y/o apellido</option>
						 	<option value="busqueda_dni" > Número DNI </option>
						 	<option value="busqueda_sector" > Sector </option>
					 	</select>

						{!!	Form::text('paciente_id',null,['id'=>'roleid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
							<div class="input-group-append">
								{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
						 	</div>
					</div>
				{!! Form::close() !!}

				<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
					<thead >
						<tr>
							<th scope="col">id</th>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
							<th scope="col">Tipo Doc.</th>
							<th scope="col">DNI</th>
							<th scope="col">Accion</th>
							<th scope="col"></th>

						</tr>
					</thead>

					<tbody>
						@if($pacientes)
							@foreach($pacientes as $paciente)
								<tr>
									<td id="paciente_id">{{$paciente->get_id()}}</td>
									<td>{{$paciente->get_name()}}</td>
									<td>{{$paciente->get_apellido()}}</td>
									<td>{{$paciente->get_tipo_documento_name()}}</td>
									<td>{{$paciente->get_numero_doc()}}</td>

									<td><a href="#" class="btn btn-primary pull-right crear_menu" data-paciente="{{$paciente}}" data-paciente_name="{{$paciente->get_name()}}" data-patologias="{{$paciente->persona->patologias}}" data-toggle="modal" data-target="#create">
									    Crear Menu
									</a></td>
									@if($paciente->acompananteActual())
									<td><a href="#" class="btn btn-primary pull-right crear_menu" data-paciente="{{$paciente->acompananteActual()->persona}}" data-paciente_name="{{$paciente->acompananteActual()->persona->name}}" data-patologias="{{$paciente->acompananteActual()->persona->patologias}}" data-toggle="modal" data-target="#create">
									    Menu Acompa.
									</a></td>
									@endif
								</tr>
							@endforeach
						@endif

				</table>
			</div>
		</div>
	</div>
</div>
@if($pacientes)
	<div class="modal fade" id="create">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header" id="modal-header">

						</div>
						<div class="modal-body">
							<div id="p_body">

							</div>
							<div id="alert-modal" class="alert alert-modal alert-danger"></div>
							<table>
								<tr>
									<td>
									{!!	Form::label('hor_id', 'Horario')!!}
									<select class="browser-default custom-select" data-paciente="{{$paciente}}" id="horario_id" name="horario_id">
										<option selected value= 0> Seleccione horario </option>
										@foreach($horarios as $horario)
										<option value= {{$horario->id}} >{{$horario->name}}</option>
										@endforeach
									</select>
									</td>
									<td>
										{!!	Form::label('racion_id', 'Raciones Recomendadas')!!}
										<select class="browser-default custom-select" id="racion_id" name="racion_id">
											<option value= 0>Raciones recomendadas</option>
										</select>
									</td>
								</tr>
							</table>

						</div>
						<div class="modal-footer">
								<a href ="{{ route('raciones.create') }}" class="btn btn-primary" target="_blank">Nueva Racion</a>
								<a href="" class="btn btn-success guardar_menu" >Guardar</a>
						</div>

				</div>
		</div>
	</div>
@endif
@endsection
@section('script')
 <script src="{{asset('js/menu_persona-script.js')}}"></script>

@endsection
