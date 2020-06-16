@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item"><a href="{{route('menu_persona.index') }}">Menús</a></li>
<li class="breadcrumb-item active">Crear menús a Personal</li>
@endsection
@section('titulo')
Crear menús para Personal
@endsection
@section('content')
 	@include('layouts.error')
<div>
	<p>
		<span id="users-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-raciones" class="alert alert-info">Busqueda por: {{$busqueda_por}} {{$query}}</div>
	@endif
</div>

<div class="container">
  <div class="table-responsive">
		<div class="col-md-8 col-md-offset-1">

			<div class="panel-heading">
				{!!Form::open(['route'=>'menu_persona.create_personal','method'=>'GET']) !!}
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
			</div>
		</div>
	</div>
</div>
<div class="container">
  <div class="table-responsive">
		<div class="col-md-auto col-md-offset-1">
				<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
					<thead >
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
							<th scope="col">Tipo Doc.</th>
							<th scope="col">Número de doc.</th>
              <th scope="col">Sector</th>
							<th scope="col">Acción</th>
							<th scope="col"></th>

						</tr>
					</thead>

					<tbody>
						@if($personal)
							@foreach($personal as $p)
								<tr>
									<td>{{$p->persona->name}}</td>
									<td>{{$p->persona->apellido}}</td>
									<td>{{$p->persona->tipoDocumento->name}}</td>
									<td>{{$p->persona->numero_doc}}</td>
                  @if($p->persona->sectorFecha(date("Y-m-d")))
										<td>{{$p->persona->sectorFecha(date("Y-m-d"))->name}}</td>
									@else
										<td>-</td>
									@endif
									<td><a href="#" class="btn btn-primary pull-right crear_menu" data-paciente="{{$p}}" data-paciente_name="{{$p->persona->name}}" data-patologias="{{$p->persona->patologias}}" data-toggle="modal" data-target="#create">
									    Crear menú
									</a></td>
								</tr>
							@endforeach
						@endif

				</table>
			</div>
		</div>
	</div>
</div>
@if($personal)
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
									<select class="browser-default custom-select" data-paciente="{{$p}}" id="horario_id" name="horario_id">
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

  <script type="text/javascript">
   $(document).ready(function(){
		 	document.getElementById("nav-nutricion").setAttribute("class", "nav-link active");
      document.getElementById("nav-menus").setAttribute("class", "nav-link active");
     });
  </script>

@endsection
