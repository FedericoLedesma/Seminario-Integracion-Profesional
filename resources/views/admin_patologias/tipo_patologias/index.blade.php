@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Tipos de patologías</li>
@endsection
@section('titulo')
	TIPOS DE PATOLOGÍAS REGISTRADAS
@endsection
@section('content')

	@include('layouts.error')


<form method="get" action={{ route('tipospatologias.create') }}>

		<button class="btn btn-primary" type="submit">Agregar tipo de Patología</button>


</form>
<div>
	<p>
		<span id="personas-total">
			<!-- Aca deben ir el total de Patologias -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-tipopatologia" class="alert alert-info">Patologías con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
  <div class="table-responsive">
    <div class="col-md-8 col-md-offset-2">
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
				</div>
			</div>
	  </div>
	</div>
	<div class="container">
	  <div class="table-responsive">
	    <div class="col-md-auto col-md-offset-2">
					<div class="panel-heading">
					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Observación</th>
								<th scope="col">Acción</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($tipos_patologias)
							@foreach($tipos_patologias as $tipoPatologia)
							<tr>
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
@endsection
@section('script')
 <script src="{{asset('js/tipo_patologia-script.js')}}"></script>

 <script type="text/javascript">
 	$(document).ready(function(){
 		document.getElementById("nav-tipospatologias").setAttribute("class", "nav-link active");
		document.getElementById("nav-patologias").setAttribute("class", "nav-link active");
 		});
 </script>

@endsection
