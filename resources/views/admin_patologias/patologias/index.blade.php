@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Patologías</li>
@endsection
@section('titulo')
	PATOLOGÍAS REGISTRADAS
@endsection
@section('content')
	@include('layouts.error')

<form method="get" action={{ route('patologias.create') }}>
		<button class="btn btn-primary" type="submit">Agregar Patología</button>
</form>
<div>
	<p>
		<span id="personas-total">
			<!-- Aca deben ir el total de Patologias -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-patologia" class="alert alert-info">Patologías con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>


    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->

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
				</div>
				<div class="col-md-auto col-md-offset-2">
					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Descripción</th>
								<th scope="col">Tipo de Patología</th>
								<th scope="col">Acción</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($patologias)
							@foreach($patologias as $patologia)
							<tr>
								<td>{{$patologia->name}}</td>
								<td>{{$patologia->descripcion}}</td>
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


@endsection
@section('script')
 <script src="{{asset('js/patologia-script.js')}}"></script>
 <script type="text/javascript">
 	$(document).ready(function(){
 		 document.getElementById("nav-patologias").setAttribute("class", "nav-link active");
 		 document.getElementById("nav-patologias-todas").setAttribute("class", "nav-link active");
 		});
 </script>
@endsection
