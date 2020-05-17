@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Tipo de Patologias</li>
@endsection
@section('content')

<!-- INDEX DEL ROL -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->



	    <h1>Tipos de Patologias registradas</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<form method="get" action={{ route('tipospatologias.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Tipo de Patologia</button>


</form>
<div>
	<p>
		<span id="personas-total">
			<!-- Aca deben ir el total de Patologias -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-tipopatologia" class="alert alert-info">Patologias con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">
				 {!!Form::open(['route'=>'tipospatologias.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_id" >ID</option>
						 <option value="busqueda_name" >Nombre</option>
					 </select>

						 {!!	Form::text('tipo_patologiaid',null,['id'=>'tipo_patologiaid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
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
								<th scope="col">Observacion</th>
								<th scope="col">Accion</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($tipos_patologias)
							@foreach($tipos_patologias as $tipoPatologia)
							<tr>
								<td>{{$tipoPatologia->id}}</td>
								<td>{{$tipoPatologia->name}}</td>
								<td>{{$tipoPatologia->observacion}}</td>
								<td>{!!link_to_route('tipospatologias.show', $title = 'VER', $parameters = [$tipoPatologia],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								{!! Form::model($tipoPatologia, ['route' => ['tipospatologias.destroy', $tipoPatologia], 'method'=> 'DELETE'])!!}
								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $tipoPatologia }}">Eliminar</button></td>

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
 <script src="{{asset('js/tipo_patologia-script.js')}}"></script>

@endsection
