@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
	<li class="breadcrumb-item active">Habitaciones</li>
@endsection
@section('titulo')
	HABITACIONES REGISTRADAS
@endsection
@section('content')

	@include('layouts.error')

<form method="get" action={{ route('habitaciones.create') }}>

		<button class="btn btn-primary" type="submit">Agregar habitación</button>

</form>
<div>
	<p>
		<span id="alimentos-total">
			<!-- Aca deben ir el total de habitaciones -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-habitacion" class="alert alert-info">Habitaciones con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
					 <div class="panel-heading">
							 {!!Form::open(['route'=>'habitaciones.index','method'=>'GET']) !!}
								 <div class="input-group mb-3">

									 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
										 <option value="busqueda_name" >Nombre</option>
									 </select>

									 {!!	Form::text('sectorid',null,['id'=>'sectorid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
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
								<table class="table table-striped table-hover ">
									<thead >
										<tr>
											<th scope="col">Nombre</th>
											<th scope="col">Descripcion</th>
											<th scope="col">Sector</th>
											<th scope="col">Acción</th>
											<th scope="col"></th>

										</tr>
									</thead>

									<tbody>
									@if($habitacion)
										@foreach($habitacion as $h)
										<tr>
											<td>{{$h->name}}</td>
											<td>{{$h->descripcion}}</td>
											<td>{{$h->get_sector_name()}}</td>
											<td>{!!link_to_route('habitaciones.show', $title = 'VER', $parameters = [$h],['class' => 'btn btn-info'], $attributes = [])!!}</td>

											{!! Form::model($h, ['route' => ['habitaciones.destroy', $h], 'method'=> 'DELETE'])!!}
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
 <script src="{{asset('js/habitacion-script.js')}}"></script>
  <script type="text/javascript">
   $(document).ready(function(){
      document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
			document.getElementById("nav-administracion-habitaciones").setAttribute("class", "nav-link active");
     });
  </script>
@endsection
