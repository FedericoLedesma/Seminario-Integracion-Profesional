@extends('layouts.plantilla')
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	  
	    {!!Form::open(['method'=>'post','action'=>'AdminRolesController@store'])!!}
	    <h1>Agregar rol</h1>
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
		    {!!	Form::submit('Crear Rol')!!}
		    </td>
		    <td>
		   	{!!	Form::reset('Borrar')!!}
		   	</td>
		   	</tr>
		 </table>
		{!! Form::close() !!}

@endsection