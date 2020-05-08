@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')


<!-- CREATE PERMISSION -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	    {!!Form::open(['method'=>'post','action'=>'AdminPermissionController@store'])!!}
	    <h1>Agregar permiso</h1>
	      @include('layouts.error')
	    <table>
	    	<tr>
	    	<td>
		    {!!	Form::label('name_accion', 'ACCION')!!}
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
					{!!	Form::label('name_table', 'TABLA')!!}
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
