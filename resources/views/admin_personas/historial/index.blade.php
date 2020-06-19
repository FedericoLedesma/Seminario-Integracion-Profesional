@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Historial de pacientes</title>
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Historial de pacientes</li>
@endsection
@section('titulo')
Historial de pacientes
@endsection
@section('content')

	@include('layouts.error')


	<a href="{{action('HistorialInternacionController@create')}}" class="btn btn-primary">Ingreso de pacientes</a>
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


    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-auto col-md-offset-2">
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
					{!!	Form::label('titulo_tabla', 'Pacientes activos')!!}
					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Documento</th>
								<th scope="col">Fecha ingreso</th>
								<th scope="col">Sector</th>
								<th scope="col">Habitación</th>
								<th scope="col">Acción</th>
								<th scope="col">Dar alta</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($historiales)
							@foreach($historiales as $historial)
							<tr>
								<td>{{$historial->get_name()}} {{$historial->get_apellido()}}</td>
								<td>{{$historial->get_tipo_documento_name()}} {{$historial->get_numero_doc()}}</td>
								<td>{{date("d/m/Y", strtotime($historial->get_fecha_ingreso()))}}</td>
								<td>{{$historial->get_sector_actual_name()}}</td>
								<td>{!!link_to_route('habitaciones.historial', $title = $historial->get_habitacion_actual_name(), $parameters = [$historial->get_habitacion_actual()],['class' => 'btn btn-info'], $attributes = [])!!}</td>
								<td>{!!link_to_route('historialInternacion.show', $title = 'VER', $parameters = [$historial],['class' => 'btn btn-info'], $attributes = [])!!}</td>
								<td>{!!link_to_route('historialInternacion.alta', $title = 'ALTA', $parameters = [$historial],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								{!! Form::model($historial, ['route' => ['historialInternacion.destroy', $historial->id], 'method'=> 'DELETE'])!!}
								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $historial->id }}">Eliminar</button></td>
								{!! Form::close() !!}

							</tr>
								@endforeach
							@endif

					</table>
				</div>
				</div>
			  </div>

@endsection
@section('script')
 <script src="{{asset('js/historial-script.js')}}"></script>
 <script type="text/javascript">
	 $(document).ready(function(){
		 document.getElementById("nav-enfermeria").setAttribute("class","nav-link active");
		 document.getElementById("nav-internacion").setAttribute("class","nav-link active");
		 });
 </script>
@endsection
