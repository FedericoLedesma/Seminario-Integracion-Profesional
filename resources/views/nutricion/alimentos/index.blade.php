@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
	<li class="breadcrumb-item active">Alimentos</li>
@endsection
@section('content')

<!-- INDEX DEL ROL -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	    <h1>Alimentos registrados</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<form method="get" action={{ route('alimentos.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Alimento</button>

</form>
<div>
	<p>
		<span id="alimentos-total">
			<!-- Aca deben ir el total de Alimentos -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-alimento" class="alert alert-info">Alimentos con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
					 <div class="panel-heading">
							 {!!Form::open(['route'=>'alimentos.index','method'=>'GET']) !!}
								 <div class="input-group mb-3">

									 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
										 <option value="busqueda_id" >ID</option>
										 <option value="busqueda_name" >Nombre</option>
									 </select>

									 {!!	Form::text('alimentoid',null,['id'=>'alimentoid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
									 <div class="input-group-append">
									{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
									 </div>
								 </div>
								{!! Form::close() !!}

								<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
									<thead >
										<tr>
											<th scope="col">id</th>
											<th scope="col">Nombre</th>
											<th scope="col">Accion</th>
											<th scope="col"></th>

										</tr>
									</thead>

									<tbody>
									@if($alimentos)
										@foreach($alimentos as $alimento)
										<tr>
											<td>{{$alimento->id}}</td>
											<td>{{$alimento->name}}</td>
											<td>{!!link_to_route('alimentos.show', $title = 'VER', $parameters = [$alimento],['class' => 'btn btn-info'], $attributes = [])!!}</td>

											{!! Form::model($alimento, ['route' => ['alimentos.destroy', $alimento], 'method'=> 'DELETE'])!!}
											<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $alimento }}">Eliminar</button></td>

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
 <script src="{{asset('js/alimento-script.js')}}"></script>
 <script type="text/javascript">
 	$(document).ready(function(){
 		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
 		document.getElementById("nav-alimentos").setAttribute("class","nav-link active");
 		});
 </script>

@endsection
