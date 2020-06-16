@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Personal del hospital</title>
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Personal</li>
@endsection
@section('titulo')
PERSONAL REGISTRADO
@endsection
@section('content')

	@include('layouts.error')

	<a href="{{action('PersonalController@create')}}" class="btn btn-primary">Ingresar nuevo personal</a>
<div>
	<p>
		<span id="users-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($notificacion)
		<div id="alert" name="alert-roles" class="alert alert-info">{{$notificacion}}</div>
	@endif
</div>

<div class="container">
    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">
				 {!!Form::open(['route'=>'personal.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_nombre_persona" >Nombre y/o apellido</option>
						 <option value="busqueda_dni" > Número doc. </option>
						 <option value="busqueda_nombre_sector" > Sector </option>
					 </select>

						 {!!	Form::text('roleid',null,['id'=>'roleid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
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
					{!!	Form::label('titulo_tabla', 'Personal del hospital')!!}
					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>

								<th scope="col">Nombre</th>
								<th scope="col">Documento</th>
								<th scope="col">Sector</th>
								<th scope="col">Acción</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($personales)
							@foreach($personales as $personal)
							<tr>
								<td>{{$personal->get_name()}} {{$personal->get_apellido()}}</td>
								<td>{{$personal->get_tipo_documento_name()}} {{$personal->get_numero_doc()}}</td>
								<td>{{$personal->get_sector_name()}}</td>
								<td>{!!link_to_route('personal.show', $title = 'Ver', $parameters = [$personal],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								{!! Form::model($personal, ['route' => ['personal.destroy', $personal], 'method'=> 'DELETE'])!!}
								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $personal }}">Eliminar</button></td>
								{!! Form::close() !!}

							</tr>
								@endforeach
							@endif

					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
 <script src="{{asset('js/personal-script.js')}}"></script>

 <script type="text/javascript">
  $(document).ready(function(){
     document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
     document.getElementById("nav-administracion-personal").setAttribute("class", "nav-link active");
    });
 </script>

@endsection
