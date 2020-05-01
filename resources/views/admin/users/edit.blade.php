@extends('layouts.layout')
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($user, ['route' => ['users.update', $user->id], 'method'=> 'PUT'])!!}
	 	@if($user)
	    <h1>EDITAR usuarios</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-striped">
	    	<tr>
	    	<td>	
		    {!!	Form::label('id', 'ID')!!}
		    </td>
		    <td>
		   	{!!	Form::label($user->id)!!}
		   	</td>
		   	</tr>
	    	<tr>
	    	<td>	
		    {!!	Form::label('dni', 'DNI')!!}
		    </td>
		    <td>
		   	{!!	Form::label($user->dni)!!}
		   	</td>		   	
		   	</tr>
		   	<tr>
	    	<td>	
		    {!!	Form::label('name', 'NOMBRE')!!}
		    </td>
		    <td>
		   	{!!	Form::text('name',$user->name)!!}
		   	</td>
		   	</tr>
		   	<tr>
		   	<td>	
		    {!!	Form::label('role', 'ROL')!!}
		    </td>
		   	<td>		   	
		   	@if($roles)
		   
	
		   		<select name="role_id">
		   	@foreach ($roles as $role)
		
    		<!-- Opciones de la lista -->
			    <option value="{{$role->id}}" >{{$role->name}}</option> <!-- Opción por defecto -->
			    
			    
			 
		   	@endforeach
		   	 </select>
		   	 	@endIf
		   	</td>
		   	</tr>
		   	<tr>
	    	<td>	
		     <td>{!!Form::submit('Guardar')!!}
		    </td>
		    
		   	</tr>
		 </table>
		 @endif
		 	{!!link_to_route('users.show', $title = 'CANCELAR', $parameters = [$user], $attributes = [])!!}
		 </div>
	 </div>
	{!! Form::close() !!}
@endsection