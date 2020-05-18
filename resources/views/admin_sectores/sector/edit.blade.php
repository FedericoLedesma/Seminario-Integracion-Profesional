@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('sectores.index') }}">Sectores</a></li>
		<li class="breadcrumb-item active">Editar sector</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($sector, ['route' => ['sectores.update', $sector->id], 'method'=> 'PUT'])!!}
	 	@if($sector)
	    <h1>Editar Sector  {{$sector->name}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
        <tr>
	    		<td>ID </td>
				<td>{{$sector->id}}</td>
  			</tr>
        <tr>
  				<td>Nombre </td>
  				<td>{!!	Form::text('name',$sector->name)!!}</td>
  			</tr>
        <tr>
  				<td>Descripcion </td>
  				<td>{!!	Form::text('descripcion',$sector->descripcion)!!}</td>
  			</tr>
		   	<tr>
  		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
  		    </td>
        </tr>
        <tr>
		    <td>
		   	{!!link_to_route('sectores.show', $title = 'CANCELAR', $parameters = [$sector->id], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif

		</div>
		</div>
@endsection
