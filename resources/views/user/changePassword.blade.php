@extends('layouts.layout')
@section('titulo')
Configuraci&oacute;n de mi perfil
@endsection
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	{!! Form::model($user, ['route' => ['user.updatepass', $user->id], 'method'=> 'PUT'])!!}
	@if($user)
	<h2>Cambiar password</h2>
	@include('layouts.error')
	<table>
		<tr>
		   	<td>
			<div class="form-group">
			    <label for="exampleInputPassword1">Contrase&ntilde;a Actual</label>
			    <input type="password" name="mypassword"class="form-control" id="exampleInputPassword1">
			</div>
		   	</td>
		</tr>
		<tr>
		   	<td>
			<div class="form-group">
			    <label for="exampleInputPassword1">Contrase&ntilde;a Nueva</label>
			    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
			</div>
		   	</td>
		</tr>
		<tr>
		   	<td>
			<div class="form-group">
			    <label for="exampleInputPassword1">Repetir Contrase&ntilde;a</label>
			    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
			</div>
		   	</td>
		</tr>

		</table>

		 <button type="submit" class="btn btn-primary">Guardar Cambios</button>

	@endif


@endsection
