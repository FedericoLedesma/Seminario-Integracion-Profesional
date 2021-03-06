@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item"><a href="{{route('permisos.index') }}">Permisos</a></li>
<li class="breadcrumb-item active">Crear</li>
@endsection
@section('titulo')
Agregar Permiso
@endsection
@section('content')


<!-- CREATE PERMISSION -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	    {!!Form::open(['method'=>'post','action'=>'AdminPermissionController@store'])!!}

	      @include('layouts.error')
	    <table>
	    	<tr>
	    	<td>
		    {!!	Form::label('name_accion', 'ACCIÓN')!!}
		    </td>
		    <td>
					<select class="custom-select" id="option-accion" name="name_accion">
						@if($acciones)
						@foreach($acciones as $accion)
							<option value="{{$accion}}">{{$accion}}</option>
						@endforeach
						</select>
						@endif
		    	</td>
		  	</tr>
				<tr>
					<td>
					{!!	Form::label('name_table', 'MODULO')!!}
					</td>
					<td>
						<select class="custom-select" id="option-tabla" name="name_table">
							@if($tablas)
							@foreach($tablas as $tabla)
								<option value="{{$tabla}}">{{$tabla}}</option>
							@endforeach
							</select>
							@endif
						</td>
					</tr>
				</tr>
		   	<tr>
	    	<td>
		    {!!	Form::submit('Crear permiso')!!}
		    </td>
		    <td>
		   	{!!	Form::reset('Borrar')!!}
		   	</td>
		   	</tr>
		 </table>
		{!! Form::close() !!}

@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		 document.getElementById("nav-permisos").setAttribute("class", "nav-link active");
		 document.getElementById("nav-permisos-create").setAttribute("class", "nav-link active");
		});
</script>
@endsection
