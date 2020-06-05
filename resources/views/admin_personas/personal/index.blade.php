@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Personal</li>
@endsection
@section('content')

<!-- INDEX DEL ROL -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	  	<title>Personal del hospital</title>

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
	<a href="{{action('PersonalController@create')}}" class="btn btn-primary">Ingresar nuevo personal</a>
<div>
	<p>
		<span id="users-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($notificacion)
		<div id="alert" name="alert-roles" class="alert alert-info">{{$notificacion}}</div>
	@endif
</div>

<div class="container">
    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">
				 {!!Form::open(['route'=>'historialInternacion.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_nombre_persona" >Nombre y/o apellido</option>
						 <option value="busqueda_dni" > Número DNI </option>
						 <option value="busqueda_nombre_sector" > Sector </option>
					 </select>

						 {!!	Form::text('roleid',null,['id'=>'roleid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
						 <div class="input-group-append">
							{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
						 </div>
					 </div>
					{!! Form::close() !!}
					{!!	Form::label('titulo_tabla', 'Personal del hospital')!!}
					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">id</th>
								<th scope="col">Nombre</th>
								<th scope="col">Documento</th>
								<th scope="col">Sector</th>
								<th scope="col">Accion</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($personales)
							@foreach($personales as $personal)
							<tr>
								<td>{{$personal->get_id()}}</td>
								<td>{{$personal->get_name()}} {{$personal->get_apellido()}}</td>
								<td>{{$personal->get_tipo_documento_name()}} {{$personal->get_numero_doc()}}</td>
								<td>{{$personal->get_sector_name()}}</td>
								<td>{!!link_to_route('personal.show', $title = 'VER', $parameters = [$personal],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								{!! Form::model($personal, ['route' => ['personal.destroy', $personal->id], 'method'=> 'DELETE'])!!}
								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $personal->id }}">Eliminar</button></td>
								{!! Form::close() !!}

							</tr>
								@endforeach
							@endif

					</table>
				</div>
				</div>
			  </div>
	</div>
</div>
@endsection
@section('script')
 <script src="{{asset('js/personal-script.js')}}"></script>

@endsection
