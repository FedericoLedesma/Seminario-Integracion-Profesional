@extends('layouts.plantilla')
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method'=> 'PUT'])!!}
	 	@if($role)
	    <h1>Editar ROL</h1>
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
		     <td>{!!Form::submit('Guardar')!!}
		    </td>
		    <td>
		   	{!!link_to_route('roles.show', $title = 'CANCELAR', $parameters = [$role], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif
		 @if($permisos)
		 @foreach($permisos as $permiso)
		 <div class="form-check">
		 	<input class="form-check-input" type="checkbox" value="{{$permiso->id}}" id="defaultCheck1">
		  	<label class="form-check-label" for="defaultCheck1">
		   		{{$permiso->name}}
		  	</label>
		  	@endforeach
		@endif
		</div>
		</div>
@endsection