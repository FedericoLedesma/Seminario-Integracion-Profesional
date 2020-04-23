@extends('layouts.plantilla')
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	  
	    {!!Form::open(['method'=>'post','action'=>'AdminUsersController@store'])!!}
	    <h1>Agregar usuarios</h1>
	      @include('layouts.error')
	    <table>
	    	<tr>
	    	<td>	
		    {!!	Form::label('dni', 'DNI')!!}
		    </td>
		    <td>
		   	{!!	Form::text('dni')!!}
		   	</td>
		   	
		   	</tr>
		   	<tr>
		   	<td>	
		    {!!	Form::label('role', 'ROL')!!}
		    </td>
		   	<td>		   	
		   	@if($roles)
		   
	
		   		<select name="role_id">
		   	@foreach ($roles as $role)
		
    		<!-- Opciones de la lista -->
			    <option value="{{$role->id}}" >{{$role->name}}</option> <!-- Opción por defecto -->
			    
			    
			 
		   	@endforeach
		   	 </select>
		   	 	@endIf
		   	</td>
		   	</tr>
		   
		   	<tr>
	    	<td>	
		    {!!	Form::label('name', 'NOMBRE')!!}
		    </td>
		    <td>
		   	{!!	Form::text('name')!!}
		   	</td>
		   	</tr>
		   <!--	<tr>
	    	  <td>	
		    {!!	Form::label('role', 'ROL')!!}
		    </td>
		    <td>
		   	{!!	Form::text('role_id')!!}
		   	</td>
		   	</tr>-->
		   	<tr>
	    	<td>	
		    {!!	Form::submit('Crear usuario')!!}
		    </td>
		    <td>
		   	{!!	Form::reset('Borrar')!!}
		   	</td>
		   	</tr>
		 </table>
		{!! Form::close() !!}

@endsection