@extends('layouts.plantilla')
@section('content')

<!-- EDIT PERMISSION -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	 {!! Form::model($permission, ['route' => ['permisos.update', $permission->id], 'method'=> 'PUT'])!!}
	 	@if($permission)
	    <h1>Editar Permiso  {{$permission->name}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    	<td>	
		    {!!	Form::label('id', 'ID')!!}
		    </td>
		    <td>
		   	{!!	Form::label($permission->id)!!}
		   	</td>
		   	</tr>
	    
		   	<tr>
	    	<td>	
		    {!!	Form::label('name', 'NOMBRE')!!}
		    </td>
		    <td>
		   	{!!	Form::text('name',$permission->name)!!}
		   	</td>
		   	</tr>		   	
		   	<tr>
	    	<td>	
		     <td>{!!Form::submit('Guardar')!!}
		    </td>
		    
		   	</tr>
		 </table>
		 @endif
	 

@endsection