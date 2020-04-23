@extends('layouts.plantilla')
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contraseņa -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($user, ['route' => ['user.update', $user->id], 'method'=> 'PUT'])!!}
	 	@if($user)
	    <h1>Configuracion de mi perfil</h1>
	      @include('layouts.error')
	    <table>
	    	<tr>
	    	<td>	
		    {!!	Form::label('id', 'ID')!!}
		    </td>
		    <td>
		   	{!!	Form::label($user->id)!!}
		   	</td>
		   	</tr>
		   	<tr>
			<td> {!! Form::label('role', 'ROLE') !!} </td>
				<?php 
					$roles=$user->getRoleNames();							
				?>								
				@foreach($roles as $rol)
			<td> {!!	Form::label($rol)!!}</td>
				@endforeach
				
			</tr>
	    	<tr>
	    	<td>	
		    {!!	Form::label('dni', 'DNI')!!}
		    </td>
		    <td>
		  {!!	Form::text('dni',$user->dni)!!}
		   	</td>		   	
		   	</tr>
		   	<tr>
	    	<td>	
		    {!!	Form::label('name', 'NOMBRE')!!}
		    </td>
		    <td>
		   	{!!	Form::text('name',$user->name)!!}
		   	</td>
		   	</tr>		 	
		   	<tr>
	    	<td>	
		     <td>{!!Form::submit('Guardar')!!}
		    </td>
		    </tr>		    
		   	<tr>
		   	<td>
		   	{!!link_to_route('users.show', $title = 'CAMBIAR CONTRASENA', $parameters = [$user], $attributes = [])!!}
		   	</td>
		   	</tr>
		   	<tr>
		    <td>
		   	{!!link_to_route('users.show', $title = 'CANCELAR', $parameters = [$user], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif
	 

@endsection