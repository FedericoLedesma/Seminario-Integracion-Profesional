@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('sectores.index') }}">Sectores</a></li>
		<li class="breadcrumb-item active">Ver Sector</li>
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
	  	@if($sector)
	    <div class="table-responsive">
	    <h2>Sector:  {{$sector->name}}</h2>
        <div class="col-md-3 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$sector->id}}</td>
			</tr>
      <tr>
				<td>Nombre </td>
				<td>{{$sector->name}}</td>
			</tr>
      <tr>
				<td>Descripcion </td>
				<td>{{$sector->descripcion}}</td>
			</tr>
      <tr>
				<td>CREADO </td>
				<td>{{$sector->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$sector->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('sectores.edit', $title = 'MODIFICAR', $parameters = [$sector->id],['class' => 'btn btn-warning'], $attributes = [])!!}




@endif
@endsection
