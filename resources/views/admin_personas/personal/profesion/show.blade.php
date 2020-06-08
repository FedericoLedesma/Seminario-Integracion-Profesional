@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('profesion.index') }}">Profesiones</a></li>
		<li class="breadcrumb-item active">Ver profesión</li>
@endsection
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
<style>
<!--
	.table-resposive{
		float:left;
	}

-->
</style>
	   @include('layouts.error')
	  	@if($cama)
	    <div class="table-responsive">
	    <h2>Cama:  {{$cama->id}}</h2>
        <div class="col-md-3 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    <td>Nombre </td>
				<td>{{$cama->get_name()}}</td>
			</tr>
      <tr>
				<td>CREADO </td>
				<td>{{$cama->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$cama->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('profesion.edit', $title = 'MODIFICAR', $parameters = [$cama->id],['class' => 'btn btn-warning'], $attributes = [])!!}




@endif
@endsection
