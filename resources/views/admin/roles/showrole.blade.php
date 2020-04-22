@extends('layouts.plantilla')
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	   @include('layouts.error')
	  	@if($role)
	  	
	  	
	    <table>
	    	<tr>
	    		<td>ID </td>
				<td>{{$role->id}}</td>
			</tr>
			<tr>
				<td>NOMBRE </td>
				<td>{{$role->name}}</td>
			</tr>
			<tr>
				<td>PERMISOS </td>
				<td>ACA VAN LOS PERMISOS</td>
			
			<tr>
				<td>CREADO </td>
				<td>{{$role->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$role->updated_at}}</td>
			</tr>			
			
		</table>
	{!!link_to_route('roles.edit', $title = 'MODIFICAR', $parameters = [$role], $attributes = [])!!}
@endif
@endsection