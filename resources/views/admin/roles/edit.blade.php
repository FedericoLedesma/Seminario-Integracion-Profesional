@extends('layouts.plantilla')
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method'=> 'PUT'])!!}
	 	@if($role)
	    <h1>EDITAR usuarios</h1>
	      @include('layouts.error')
	    <table>
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
	 

@endsection