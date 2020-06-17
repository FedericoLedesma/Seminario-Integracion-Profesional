@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
	<li class="breadcrumb-item active">Profesiones</li>
@endsection
@section('titulo')
	PROFESIONES REGISTRADAS
@endsection
@section('content')

	      @include('layouts.error')

<form method="get" action={{ route('profesion.create') }}>

		<button class="btn btn-primary" type="submit">Agregar profesión</button>

</form>
<div>
	<p>
		<span id="alimentos-total">
			<!-- Aca deben ir el total de profesion -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-cama" class="alert alert-info">Profesiones con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
					 <div class="panel-heading">
							 {!!Form::open(['route'=>'profesion.index','method'=>'GET']) !!}
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

								<table class="table table-striped table-hover ">
									<thead >
										<tr>
											<th scope="col">Nombre</th>
											<th scope="col">Acción</th>
											<th scope="col"></th>

										</tr>
									</thead>

									<tbody>
									@if($profesion)
										@foreach($profesion as $h)
										<tr>
											<td>{{$h->id}}</td>
											<td>{{$h->get_name()}}</td>
											<td>{!!link_to_route('profesion.show', $title = 'VER', $parameters = [$h],['class' => 'btn btn-info'], $attributes = [])!!}</td>

											{!! Form::model($h, ['route' => ['profesion.destroy', $h], 'method'=> 'DELETE'])!!}
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
 <script src="{{asset('js/profesion-script.js')}}"></script>

 <script type="text/javascript">
  $(document).ready(function(){
     document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
     document.getElementById("nav-administracion-profesion").setAttribute("class", "nav-link active");
    });
 </script>

@endsection
