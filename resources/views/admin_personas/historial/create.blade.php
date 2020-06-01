@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('pacientes.index') }}">Pacientes</a></li>
		<li class="breadcrumb-item active">Crear paciente</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	    {!!Form::open(['method'=>'post','action'=>'PacienteController@store'])!!}
	    <h1>Agregar paciente</h1>
	      @include('layouts.error')
	    <table>
	    	<tr>
	    	<td>
		    {!!	Form::label('name', 'Nombre')!!}
		    </td>
		    <td>
		   	{!!	Form::text('name')!!}
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
