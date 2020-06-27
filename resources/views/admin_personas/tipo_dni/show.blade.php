@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('tipoDocumento.index') }}">Tipos de documento</a></li>
		<li class="breadcrumb-item active">Ver tipo de documento</li>
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
	  	@if($tipo)




	    <div class="table-responsive">
	    <h2>Tipo de documento</h2>
        <div class="col-md-3 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$tipo->id}}</td>
			</tr>
			<tr>
				<td>NOMBRE </td>
				<td>{{$tipo->name}}</td>
			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{$tipo->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$tipo->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('tipoDocumento.edit', $title = 'MODIFICAR', $parameters = [$tipo],['class' => 'btn btn-warning'], $attributes = [])!!}


@endif
@endsection
