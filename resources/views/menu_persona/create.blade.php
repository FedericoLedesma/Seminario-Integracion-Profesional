@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('roles.index') }}">Roles</a></li>
		<li class="breadcrumb-item active">Crear Rol</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

		{!!Form::open(['route'=>'menu_persona.create','method'=>'GET']) !!}
			<div class="input-group mb-3">

			<select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
				@foreach($horarios as $horario)
				<option value= {{$horario->id}} >{{$horario->name}}</option>	
				@endforeach		
			</select>

				{!!	Form::text('roleid',null,['id'=>'roleid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
				<div class="input-group-append">
				{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
				</div>
			</div>
		{!! Form::close() !!}

	    {!!Form::open(['method'=>'post','action'=>'MenuPersonaController@store'])!!}
	    <h1>Agregar menu persona (planilla)</h1>
	      @include('layouts.error')
	    <table>
	    	<tr>
	    	<td>
		    {!!	Form::label('name', 'Nombre de la persona')!!}
		    </td>
		    <td>
			<select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_nombre_persona" >Buscar por persona</option>
						 <option value="busqueda_nombre_horario" >Buscar por horario</option>
						 <option value="busqueda_fecha" >Buscar por fecha</option>
					 </select>
		   	</td>
		   	</tr>
		   	<tr>
	    	<td>
		    {!!	Form::submit('Crear Rol',['class' => 'btn btn-success'])!!}
		    </td>
		    <td>
		   	{!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
		   	</td>
		   	</tr>
		 </table>
		{!! Form::close() !!}

@endsection
