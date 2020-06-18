@extends('layouts.layout')
@section('titulo')
MI PERFIL
@endsection
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	   @include('layouts.error')
	  	@if($user)
	  	<table>
	    	<tr>
	    		<td>ID USUARIO </td>
				<td>{{$user->id}}</td>
			</tr>
			<tr>
				<td>NÚMERO DE DOCUMENTO </td>
				<td>{{$user->dni}}</td>
			</tr>
			<tr>
				<td>TIPO DE DOCUMENTO </td>
				<td>{{$user->personal->persona->tipoDocumento->name}}</td>
			</tr>
			<tr>
				<td>NOMBRE </td>
				<td>{{$user->personal->persona->name}}</td>
			 </tr>
			 <tr>
 				<td>APELLIDO </td>
 				<td>{{$user->personal->persona->apellido}}</td>
 			 </tr>
			 <tr>
 				<td>FECHA DE NACIMIENTO </td>
 				<td>{{date("d/m/Y", strtotime($user->personal->persona->fecha_nac))}}</td>
 			 </tr>
			 <tr>
 				<td>EMAIL </td>
 				<td>{{$user->personal->persona->email}}</td>
 			 </tr>
			 <tr>
				<td>ROL </td>
				<?php
					$roles=$user->getRoleNames();
				?>
					@foreach($roles as $rol)
				<td>{{$rol}}</td>
					@endforeach

			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{date("d/m/Y H:i:s", strtotime($user->created_at))}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{date("d/m/Y H:i:s", strtotime($user->updated_at))}}</td>
			</tr>

		</table>
		@if(!($user->id==1))
			{!!link_to_route('user.config', $title = 'MODIFICAR', $parameters = [$user],['class' => 'btn btn-warning'], $attributes = [])!!}
		@endif
@endif
@endsection
