@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Personas</li>
@endsection
@section('titulo')
Personas registradas
@endsection
@section('content')

	@include('layouts.error')
<form method="get" action={{ route('personas.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Persona</button>


</form>
<div>
	<p>
		<span id="personas-total">
			<!-- Aca deben ir el total de personas -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-personas" class="alert alert-info">Personas con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">

	<div class="table-responsive">
  	<div class="col-md-auto col-md-offset-2">

 <div class="panel-heading">
				 {!!Form::open(['route'=>'personas.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_id" >ID</option>
						 <option value="busqueda_name" >Nombre</option>
					 </select>

						 {!!	Form::text('personaid',null,['id'=>'personaid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
						 <div class="input-group-append">
							{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
						 </div>
					 </div>
					{!! Form::close() !!}

					<table class="table table-striped"><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">id</th>
								<th scope="col">N.Doc</th>
								<th scope="col">Nombre</th>
								<th scope="col">Apellido</th>
								<th scope="col">Fecha Nac.</th>
								<th scope="col">EMail</th>
								<th scope="col">Accion</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($personas)
							@foreach($personas as $persona)
							<tr>
								<td>{{$persona->id}}</td>
								<td>{{$persona->numero_doc}}</td>
								<td>{{$persona->name}}</td>
								<td>{{$persona->apellido}}</td>
								<td>{{$persona->fecha_nac}}</td>
								<td>{{$persona->email}}</td>
								<td>{!!link_to_route('personas.show', $title = 'VER', $parameters = [$persona],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								{!! Form::model($persona, ['route' => ['personas.destroy', $persona], 'method'=> 'DELETE'])!!}
						<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $persona }}">Eliminar</button></td>
									<!--<td><button type="submit" class="btn btn-danger eliminar">Eliminar</button></td>-->
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
 <script src="{{asset('js/persona-script.js')}}"></script>

 <script type="text/javascript">
  $(document).ready(function(){
    document.getElementById("nav-personas").setAttribute("class", "nav-link active");
    document.getElementById("nav-personas-todas").setAttribute("class", "nav-link active");
    });
 </script>
@endsection
