@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('alimentos.index') }}">Alimentos</a></li>
		<li class="breadcrumb-item active">Editar Alimento</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($alimento, ['route' => ['alimentos.update', $alimento->id], 'method'=> 'PUT'])!!}
	 	@if($alimento)
	    <h1>Editar Alimento  {{$alimento->name}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
        <tr>
	    		<td>ID </td>
				<td>{{$alimento->id}}</td>
  			</tr>
        <tr>
  				<td>Nombre </td>
  				<td>{!!	Form::text('name',$alimento->name)!!}</td>
  			</tr>
		   	<tr>
  		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
  		    </td>
        </tr>
        <tr>
		    <td>
		   	{!!link_to_route('alimentos.show', $title = 'CANCELAR', $parameters = [$alimento], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif

		</div>
		</div>
@endsection
