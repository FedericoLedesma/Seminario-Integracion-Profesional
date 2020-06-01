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

	  	<title>Índice de pacientes</title>

	    <h1></h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
	<a href="{{action('PacienteController@create')}}" class="btn btn-primary">Agregar pacientes</a>
<div>
	<p>
		<span id="users-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-roles" class="alert alert-info">Roles con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">
				 {!!Form::open(['route'=>'pacientes.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_name" >Nombre y/o apellido</option>
						 <option value="busqueda_dni" > Número DNI </option>
						 <option value="busqueda_sector" > Sector </option>
					 </select>

						 {!!	Form::text('roleid',null,['id'=>'roleid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
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
								<td>{{$paciente->get_id()}}</td>
								<td>{{$paciente->get_name()}}</td>
								<td>{{$paciente->get_apellido()}}</td>
								<td>{{$paciente->get_tipo_documento_name()}}</td>
								<td>{{$paciente->get_numero_doc()}}</td>
								<td>{!!link_to_route('roles.show', $title = 'VER', $parameters = [$paciente],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								{!! Form::model($paciente, ['route' => ['pacientes.destroy', $paciente->id], 'method'=> 'DELETE'])!!}
								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $paciente->id }}">Eliminar</button></td>
								{!! Form::close() !!}

							</tr>
								@endforeach
							@endif

					</table>
				</div>
				</div>
			  </div>
				 </div>
				<!--</div>-->
@endsection
@section('script')
 <script src="{{asset('js/paciente-script.js')}}"></script>

@endsection
