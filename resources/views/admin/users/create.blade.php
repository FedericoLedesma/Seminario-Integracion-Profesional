@extends('layouts.layout')
@section('titulo')
Agregar usuarios
@endsection
@section('content')


<!-- mostrar una tabla con los roles que existen -->
	  
	    {!!Form::open(['method'=>'post','action'=>'AdminUsersController@store'])!!}
	
	    <div class="alert alert-info col-md-8" role="alert">
		  Recuerde que la contrase&ntilde;a predeterminada es el DNI del usuario
		</div>
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