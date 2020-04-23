@extends('layouts.plantilla')
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($user, ['route' => ['user.updatepass', $user->id], 'method'=> 'PUT'])!!}
	@if($user)
	<h1>Configuracion de mi perfil</h1>
	@include('layouts.error')
	<table>
		<tr>
		   	<td>
			<div class="form-group">
			    <label for="exampleInputPassword1">Password Actual</label>
			    <input type="password" name="mypassword"class="form-control" id="exampleInputPassword1">
			</div>
		   	</td>
		</tr>
		<tr>
		   	<td>
			<div class="form-group">
			    <label for="exampleInputPassword1">Password Nuevo</label>
			    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
			</div>
		   	</td>
		</tr>
		<tr>
		   	<td>
			<div class="form-group">
			    <label for="exampleInputPassword1">Repetir Password</label>
			    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
			</div>
		   	</td>
		</tr> 
		<tr>
		 <button type="submit" class="btn btn-primary">Submit</button>
		</tr>
		</table>	
		   	
	@endif
	 

@endsection