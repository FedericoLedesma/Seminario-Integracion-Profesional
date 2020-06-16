@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('pacientes.index') }}">Pacientes</a></li>
		<li class="breadcrumb-item active">Crear paciente</li>
@endsection
@section('titulo')
  Agregar paciente
@endsection
@section('content')
    {!!Form::open(['method'=>'post','action'=>'PacienteController@store'])!!}

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
