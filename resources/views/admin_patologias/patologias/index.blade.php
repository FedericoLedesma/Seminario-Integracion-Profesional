@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Patologias</li>
@endsection
@section('content')

<!-- INDEX DEL ROL -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->



	    <h1>Patologias registradas</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<form method="get" action={{ route('patologias.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Patologia</button>


</form>
<div>
	<p>
		<span id="personas-total">
			<!-- Aca deben ir el total de Patologias -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-patologia" class="alert alert-info">Patologias con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">
				 {!!Form::open(['route'=>'patologias.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_id" >ID</option>
						 <option value="busqueda_name" >Nombre</option>
					 </select>

						 {!!	Form::text('patologiaid',null,['id'=>'patologiaid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
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
								<th scope="col">Tipo de Patologia</th>
								<th scope="col">Accion</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($patologias)
							@foreach($patologias as $patologia)
							<tr>
								<td>{{$patologia->id}}</td>
								<td>{{$patologia->name}}</td>
								<td>{{$patologia->tipo_patologia_id}}</td>
								<td>{!!link_to_route('patologias.show', $title = 'VER', $parameters = [$patologia],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								{!! Form::model($patologia, ['route' => ['patologias.destroy', $patologia], 'method'=> 'DELETE'])!!}
								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $patologia }}">Eliminar</button></td>

								{!! Form::close() !!}
							</tr>
								@endforeach
							@endif

					</table>
				</div>
				</div>
			  </div>
				 </div>
				<!--</div>-->
@endsection
@section('script')
 <script src="{{asset('js/patologia-script.js')}}"></script>

@endsection