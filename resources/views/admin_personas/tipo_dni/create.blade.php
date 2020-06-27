@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('tipoDocumento.index') }}">Tipos de documentos</a></li>
		<li class="breadcrumb-item active">Crear tipo de documento</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	    {!!Form::open(['method'=>'post','action'=>'TipoDocumentoController@store'])!!}
	    <h1>Agregar tipo de documento</h1>
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
		    {!!	Form::submit('Crear tipo de documento',['class' => 'btn btn-success'])!!}
		    </td>
		    <td>
		   	{!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
		   	</td>
		   	</tr>
		 </table>
		{!! Form::close() !!}

@endsection
