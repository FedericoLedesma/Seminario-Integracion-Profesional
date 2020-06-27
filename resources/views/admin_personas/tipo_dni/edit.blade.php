@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('tipoDocumento.index') }}">Tipo de documento</a></li>
		<li class="breadcrumb-item active">Editar tipo de documento</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($tipo, ['route' => ['tipoDocumento.update', $tipo->id], 'method'=> 'PUT'])!!}
	 	@if($tipo)
	    <h1>Editar Rol  {{$tipo->name}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    	<td>
		    {!!	Form::label('id', 'ID')!!}
		    </td>
		    <td>
		   	{!!	Form::label($tipo->id)!!}
		   	</td>
		   	</tr>

		   	<tr>
	    	<td>
		    {!!	Form::label('name', 'NOMBRE')!!}
		    </td>
		    <td>
		   	{!!	Form::text('name',$tipo->name)!!}
		   	</td>
		   	</tr>
		   	<tr>
	    	<td>
		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
		    </td>
		    <td>
		   	{!!link_to_route('tipoDocumento.show', $title = 'CANCELAR', $parameters = [$tipo], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif

		 




		</div>
		</div>
@endsection
