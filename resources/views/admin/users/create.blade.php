@extends('layouts.layout')
@section('navegacion')
<li class="breadcrumb-item"><a href="{{route('users.index') }}">Usuarios</a></li>
<li class="breadcrumb-item active">Crear</li>
@endsection
@section('titulo')
Agregar usuarios
@endsection
@section('content')


<!-- mostrar una tabla con los roles que existen -->
	@if($mensaje)
	<div class="alert alert-danger col-md-8" role="alert">
	{{$mensaje}}
	</div>
	@endif
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


		   		<select class="browser-default custom-select" name="role_id">
					<!--	<option selected>Seleccione el Rol</option>validar-->
		   	@foreach ($roles as $role)

    		<!-- Opciones de la lista -->
					<option value="{{$role->id}}" >{{$role->name}}</option> <!-- Opci�n por defecto -->



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
		    {!!	Form::submit('Crear usuario',['class' => 'btn btn-success'])!!}
		    </td>
		    <td>
		   	{!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
		   	</td>
		   	</tr>
		 </table>
		{!! Form::close() !!}

@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			 console.log("hola");
			 document.getElementById("nav-usuarios").setAttribute("class", "nav-link active");
			 document.getElementById("nav-usuarios-create").setAttribute("class", "nav-link active");
			});
	</script>
@endsection
