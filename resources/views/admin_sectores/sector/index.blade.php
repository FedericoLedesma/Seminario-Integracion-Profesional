@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
	<li class="breadcrumb-item active">Sectores</li>
@endsection
@section('content')

<!-- INDEX DEL ROL -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	    <h1>Sectores registrados</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<form method="get" action={{ route('sectores.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Sector</button>

</form>
<div>
	<p>
		<span id="alimentos-total">
			<!-- Aca deben ir el total de Sectores -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-sector" class="alert alert-info">Sectores con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
					 <div class="panel-heading">
							 {!!Form::open(['route'=>'sectores.index','method'=>'GET']) !!}
								 <div class="input-group mb-3">

									 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
										 <option value="busqueda_id" >ID</option>
										 <option value="busqueda_name" >Nombre</option>
									 </select>

									 {!!	Form::text('sectorid',null,['id'=>'sectorid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
									 <div class="input-group-append">
									{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
									 </div>
								 </div>
								{!! Form::close() !!}

								<table class="table table-striped table-hover ">
									<thead >
										<tr>
											<th scope="col">id</th>
											<th scope="col">Nombre</th>
											<th scope="col">Descripcion</th>
											<th scope="col">Accion</th>
											<th scope="col"></th>

										</tr>
									</thead>

									<tbody>
									@if($sectores)
										@foreach($sectores as $sector)
										<tr>
											<td>{{$sector->id}}</td>
											<td>{{$sector->name}}</td>
											<td>{{$sector->descripcion}}</td>
											<td>{!!link_to_route('sectores.show', $title = 'VER', $parameters = [$sector],['class' => 'btn btn-info'], $attributes = [])!!}</td>

											{!! Form::model($sector, ['route' => ['sectores.destroy', $sector], 'method'=> 'DELETE'])!!}
											<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $sector }}">Eliminar</button></td>

											{!! Form::close() !!}
										</tr>
											@endforeach
										@endif

									</table>
							</div>
					</div>
			</div>
</div>

@endsection
@section('script')
 <script src="{{asset('js/sector-script.js')}}"></script>

@endsection
