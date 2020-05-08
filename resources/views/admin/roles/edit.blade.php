@extends('layouts.layout')
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method'=> 'PUT'])!!}
	 	@if($role)
	    <h1>Editar Rol  {{$role->name}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    	<td>
		    {!!	Form::label('id', 'ID')!!}
		    </td>
		    <td>
		   	{!!	Form::label($role->id)!!}
		   	</td>
		   	</tr>

		   	<tr>
	    	<td>
		    {!!	Form::label('name', 'NOMBRE')!!}
		    </td>
		    <td>
		   	{!!	Form::text('name',$role->name)!!}
		   	</td>
		   	</tr>
		   	<tr>
	    	<td>
		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
		    </td>
		    <td>
		   	{!!link_to_route('roles.show', $title = 'CANCELAR', $parameters = [$role], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif

		 @if($permisosAsociados)
		  <table class="table table-bordered table-hover table-striped">
		   <tr>
		    	<td>
		    	Permisos asociados al rol {{$role->name}}
		   		</td>
		   		<td>
		   			Quitar Permiso
		   		</td>
		   </tr>
		   		@if (count($permisosAsociados)==0)
		   		<tr>
		   			<td>NO TIENE PERMISOS ASOCIADOS
		   			</td>
		   		</tr>
			@endif


		   	   @foreach($permisosAsociados as $permisoAsociado)
		   <tr>
		   		<td>
		   		<div class="form-check">
				 	<label class="form-check-label" for="defaultCheck1">
				   		{{$permisoAsociado->name}}
				  	</label>
		   		</td>
		   		<td>
		   			<input class="form-check-input" type="checkbox" name="quitarPermisos[]"value="{{$permisoAsociado->id}}" id="defaultCheck1">
		   		</td>
		   </tr>
		   	@endforeach
		  </table>
		@endif




		 @if($permisos)
		  <table class="table table-bordered table-hover table-striped">
		   <tr>
		    	<td>
		    	Permisos disponibles
		   		</td>
		   </tr>
		   	   @foreach($permisos as $permiso)
		   <tr>
		   		<td>
		   		<div class="form-check">
				 	<input class="form-check-input" type="checkbox" name="agregarPermisos[]" value="{{$permiso->id}}" id="defaultCheck{{$permiso->id}}">
				  	<label class="form-check-label" for="defaultCheck{{$permiso->id}}">
				   		{{$permiso->name}}
				  	</label>
		   		</td>
		   </tr>
		   	@endforeach
		  </table>
		@endif
		</div>
		</div>
@endsection
