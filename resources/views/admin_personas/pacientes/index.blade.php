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



	    <h1>Pacientes registradas</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<form method="get" action={{ route('pacientes.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Paciente</button>


</form>
<div>
	<p>
		<span id="personas-total">
			<!-- Aca deben ir el total de personas -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-pacientes" class="alert alert-info">Personas con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">

	<div class="table-responsive">
  	<div class="col-md-8 col-md-offset-2">

 <div class="panel-heading">
				 {!!Form::open(['route'=>'pacientes.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_id" >ID</option>
						 <option value="busqueda_dni" >Numero Documento</option>
					 </select>

						 {!!	Form::text('pacienteid',null,['id'=>'pacienteid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
						 <div class="input-group-append">
							{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
						 </div>
					 </div>
					{!! Form::close() !!}

					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">id</th>
								<th scope="col">N.Doc</th>
								<th scope="col">Nombre</th>
								<th scope="col">Apellido</th>
								<th scope="col">Fecha Nac.</th>
								<th scope="col">EMail</th>
								<th scope="col">Accion</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($pacientes)
							@foreach($pacientes as $paciente)
							<tr>
								<td>{{$paciente->id}}</td>
								<td>{{$paciente->persona->numero_doc}}</td>
								<td>{{$paciente->persona->name}}</td>
								<td>{{$paciente->persona->apellido}}</td>
								<td>{{$paciente->persona->fecha_nac}}</td>
								<td>{!!link_to_route('pacientes.show', $title = 'VER', $parameters = [$paciente],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								{!! Form::model($paciente, ['route' => ['personas.destroy', $paciente], 'method'=> 'DELETE'])!!}
								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $paciente }}">Eliminar</button></td>
									<!--<td><button type="submit" class="btn btn-danger eliminar">Eliminar</button></td>-->
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


@endsection
