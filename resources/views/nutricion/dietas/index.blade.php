@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
	<li class="breadcrumb-item active">Dietas</li>
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

<div>
	<p>
		<span id="alimentos-total">
			<!-- Aca deben ir el total de Alimentos -->

		</span>
	</p>
	@if($query)
		<div id="alert" name="alert-dieta" class="alert alert-info">Dietas con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
					 <div class="panel-heading">
							 {!!Form::open(['route'=>'dietas.index','method'=>'GET']) !!}
								 <div class="input-group mb-3">

									 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
										 <option value="busqueda_id" >ID</option>
										 <option value="busqueda_patologia" >Id Patologia</option>
									 </select>

									 {!!	Form::text('dietaid',null,['id'=>'dietaid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
									 <div class="input-group-append">
									{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
									 </div>
								 </div>
								{!! Form::close() !!}

								<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
									<thead >
										<tr>
											<th scope="col">id</th>
											<th scope="col">Patologia</th>
											<th scope="col"></th>

										</tr>
									</thead>

									<tbody>
									@if($dietas)
										@foreach($dietas as $dieta)
										<tr>
											<td>{{$dieta->id}}</td>
											<td>{{$dieta->patologia->name}}</td>


										</tr>
											@endforeach
										@endif

									</table>
							</div>
					</div>
			</div>
</div>
@endsection
