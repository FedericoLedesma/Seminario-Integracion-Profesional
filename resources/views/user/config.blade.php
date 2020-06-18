@extends('layouts.layout')
@section('titulo')
Configuracion de mi perfil
@endsection
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($user, ['route' => ['user.update', $user->id], 'method'=> 'PUT'])!!}
	 	@if($user)

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
		  {!!	Form::label('dni',$user->dni)!!}
		   	</td>
		   	</tr>
		   	<tr>
	    	<td>
		    {!!	Form::label('name', 'NOMBRE')!!}
		    </td>
		    <td>
		   	{!!	Form::label('name',$user->personal->persona->name)!!}
		   	</td>
		   	</tr>
		   	<tr>
	    	<td>
		     <td>
		    </td>
		    </tr>
		   	<tr>
		   	<td>
		   	{!!link_to_route('user.cambiarpass', $title = 'CAMBIAR CONTRASEÑA', $parameters = [$user], $attributes = ['class' => 'btn btn-info'])!!}
		   	</td>
		   	</tr>
		   	<tr>
		    <td>
		   	{!!link_to_route('users.show', $title = 'CANCELAR', $parameters = [$user], $attributes = ['class' => 'btn btn-warning'])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif


@endsection
