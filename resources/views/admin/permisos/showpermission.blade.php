@extends('layouts.plantilla')
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	   @include('layouts.error')
	  	@if($user)
	  	
	  	
	    <table>
	    	<tr>
	    		<td>ID USUARIO </td>
				<td>{{$user->id}}</td>
			</tr>
			<tr>
				<td>DNI </td>
				<td>{{$user->dni}}</td>
			</tr>
			<tr>
				<td>NOMBRE </td>
				<td>{{$user->name}}</td>
			<!-- </tr>
			 <tr>
				<td>ROLE_ID </td>
				<td>{{$user->role_id}}</td>
			</tr>-->
			<tr>
				<td>CREADO </td>
				<td>{{$user->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$user->updated_at}}</td>
			</tr>			
			
		</table>
	{!!link_to_route('users.edit', $title = 'MODIFICAR', $parameters = [$user], $attributes = [])!!}
@endif
@endsection