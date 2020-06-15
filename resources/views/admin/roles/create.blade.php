@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('roles.index') }}">Roles</a></li>
		<li class="breadcrumb-item active">Crear Rol</li>
@endsection
@section('titulo')
  Agregar Rol
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	    {!!Form::open(['method'=>'post','action'=>'AdminRolesController@store'])!!}
	      @include('layouts.error')
	    <table>
	    	<tr>
	    	<td>
		    {!!	Form::label('name', 'Nombre')!!}
		    </td>
		    <td>
		   	{!!	Form::text('name')!!}
		   	</td>
		   	</tr>
		   	<tr>
	    	<td>
		    {!!	Form::submit('Crear Rol',['class' => 'btn btn-success'])!!}
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
			 document.getElementById("nav-roles").setAttribute("class", "nav-link active");
       document.getElementById("nav-roles-create").setAttribute("class", "nav-link active");
			});
	</script>
@endsection
