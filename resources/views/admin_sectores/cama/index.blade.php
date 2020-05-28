@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
	<li class="breadcrumb-item active">Camas</li>
@endsection
@section('content')

<!-- INDEX DEL ROL -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	    <h1>Camas registradas</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<form method="get" action={{ route('camas.create') }}>

		<button class="btn btn-primary" type="submit">Agregar cama</button>

</form>
<div>
	<p>
		<span id="alimentos-total">
			<!-- Aca deben ir el total de camas -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-cama" class="alert alert-info">Camas con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
					 <div class="panel-heading">
							 {!!Form::open(['route'=>'camas.index','method'=>'GET']) !!}
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
											<th scope="col">Habitacion</th>
											<th scope="col">Sector</th>
											<th scope="col">Accion</th>
											<th scope="col"></th>

										</tr>
									</thead>

									<tbody>
									@if($cama)
										@foreach($cama as $h)
										<tr>
											<td>{{$h->id}}</td>
											<td>{{$h->get_habitacion_name()}}</td>
											<td>{{$h->get_sector_name()}}</td>
											<td>{!!link_to_route('camas.show', $title = 'VER', $parameters = [$h],['class' => 'btn btn-info'], $attributes = [])!!}</td>

											{!! Form::model($h, ['route' => ['camas.destroy', $h], 'method'=> 'DELETE'])!!}
											<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $h }}">Eliminar</button></td>

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
 <script src="{{asset('js/cama-script.js')}}"></script>

@endsection
