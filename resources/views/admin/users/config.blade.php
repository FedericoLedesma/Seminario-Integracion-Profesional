@extends('layouts.layout')
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($user, ['route' => ['users.update', $user->id], 'method'=> 'PUT'])!!}
	 	@if($user)
	    <h1>EDITAR usuarios</h1>
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
	    	<td>	
		    {!!	Form::label('dni', 'DNI')!!}
		    </td>
		    <td>
		   	{!!	Form::label($user->dni)!!}
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
		 <!--   <tr>
	    	<td>	
		    {!!	Form::label('role_id', 'ID_ROL')!!}
		    </td>
		    <td>
		   	{!!	Form::text('role_id',$user->role_id)!!}
		   	</td>
		   	</tr> -->
		   	
		   	<tr>
	    	<td>	
		     <td>{!!Form::submit('Guardar')!!}
		    </td>
		    <td>
		   	{!!link_to_route('users.show', $title = 'CANCELAR', $parameters = [$user], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif
	 

@endsection