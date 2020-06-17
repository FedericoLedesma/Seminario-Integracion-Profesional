@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Raciones</li>
@endsection
@section('titulo')
	RACIONES REGISTRADAS
@endsection
@section('content')

	@include('layouts.error')


<form method="get" action={{ route('raciones.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Ración</button>


</form>
<div>
	<p>
		<span id="personas-total">
			<!-- Aca deben ir el total de personas -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-raciones" class="alert alert-info">Raciones con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>
<div class="container">
	<div class="table-responsive">
  	<div class="col-md-8 col-md-offset-2">
 			<div class="panel-heading">
				 {!!Form::open(['route'=>'raciones.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_name" >Nombre</option>
					 </select>

						 {!!	Form::text('racionid',null,['id'=>'racionid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
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
								<th scope="col">Alimentos</th>
								<th scope="col">Acción</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($raciones)
							@foreach($raciones as $racion)
							<tr>
								<td>{{$racion->name}}</td>
								<td>{{$racion->observacion}}</td>
								<td>
									@if(count($racion->racion_alimentos)>0)
										@foreach($racion->alimentos as $alimento)
									  	{{$alimento->name}} ({{$alimento->pivot->cantidad}} @if($racion->racion_alimento($alimento->id)->unidad){{$racion->racion_alimento($alimento->id)->unidad->name}}@endif)</br>
										@endforeach
									@endif
								</td>
								<td>{!!link_to_route('raciones.show', $title = 'Ver', $parameters = [$racion->id],['class' => 'btn btn-info'], $attributes = [])!!}</td>


								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $racion }}">Eliminar</button></td>


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
 <script src="{{asset('js/racion-script.js')}}"></script>
  <script type="text/javascript">
   	$(document).ready(function(){
   		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
   		document.getElementById("nav-raciones").setAttribute("class","nav-link active");
   		});
  </script>
@endsection
