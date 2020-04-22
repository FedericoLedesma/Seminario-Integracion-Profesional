@extends('layouts.plantilla')
@section('content')


<!-- CREATE PERMISSION -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	  
	    {!!Form::open(['method'=>'post','action'=>'AdminPermissionController@store'])!!}
	    <h1>Agregar permiso</h1>
	      @include('layouts.error')
	    <table>
	    	<tr>
	    	<td>	
		    {!!	Form::label('name', 'NOMBRE')!!}
		    </td>
		    <td>
		   	{!!	Form::text('name')!!}
		   	</td>
		  	</tr>
		   	<tr>
	    	<td>	
		    {!!	Form::submit('Crear permiso')!!}
		    </td>
		    <td>
		   	{!!	Form::reset('Borrar')!!}
		   	</td>
		   	</tr>
		 </table>
		{!! Form::close() !!}

@endsection