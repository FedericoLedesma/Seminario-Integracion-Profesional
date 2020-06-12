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
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">
				 	<h3>Especialidades de {{$personal->get_name()}} {{$personal->get_apellido()}}</h3>
					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">id</th>
								<th scope="col">Nombre</th>
								<th scope="col">Accion</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($profesiones)
							@foreach($profesiones as $profesion)
							<tr>
								<td>{{$profesion->get_id()}}</td>
								<td>{{$profesion->get_name()}}</td>
								<td>{!!link_to_route('profesion.show', $title = 'VER', $parameters = [$profesion],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								{!! Form::close() !!}

							</tr>
								@endforeach
							@endif

					</table>
				</div>
				</div>
			  </div>
	</div>

	<h3>Asignar una especialidad</h3>
	<div>
		{!!Form::open(['method'=>'get','action'=>'PersonalController@addProfesion'])!!}
			<input id='personal_id' name='personal_id' value={{$personal->get_id()}} size=3></input>
			@if(true)
				<select id='profesion_id' name='profesion_id'>
					@foreach($personal->get_profesiones_disponibles() as $profesion)
						<option value='{{$profesion->get_id()}}'> {{$profesion->get_name()}} </option>
					@endforeach
				</select>
			@endif
		{!!	Form::submit('Agregar',['class' => 'btn btn-success'])!!}
		{!! Form::close() !!}
	</div>
</div>

@endsection
