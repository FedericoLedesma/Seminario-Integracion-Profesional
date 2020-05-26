<head>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
</head>

@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Roles</li>
@endsection
@section('content')

<!-- INDEX DEL ROL -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	  	<title>Menu persona</title>

	    <h1>Menues de persona (planillas)</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<container justify-content="space-evenly">
	<a href="{{action('MenuPersona_enhanced_Controller@create')}}" class="btn btn-primary">Recorrido por pabellones</a>

	<a href="{{action('MenuPersona_enhanced_Controller@create')}}" class="btn btn-primary">Búsqueda de planillas</a>

	<a href="{{action('MenuPersona_enhanced_Controller@create')}}" class="btn btn-primary">Generar planillas del personal</a>

	<a href="{{action('InformeController@index')}}" class="btn btn-primary">Informes</a>

</container>
<div>
	<p>
		<span id="menu_persona-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>


<div class="container">

    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">

				 {!!	Form::label('racion_id', 'Menús cargados para hoy')!!}

					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">Persona</th>
								<th scope="col">Horario</th>
								<th scope="col">Racion</th>
								<th scope="col">Fecha</th>
								<th scope="col">Realizado</th>
								<th scope="col">Accion</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($menus)
							@foreach($menus as $menu_persona)
							<tr>
								{{Log::debug(' Persona id: '.$menu_persona)}}
								<td>{{$menu_persona->get_persona_nombre_completo()}}</td>
								<td>{{$menu_persona->get_horario_name()}}</td>
								<td>{{$menu_persona->get_racion_name()}}</td>
								<td>{{$menu_persona['fecha']}}</td>
								<td>{{$menu_persona->isRealizado_str()}}</td>
								<td>
									<a href="{{action('InformeController@index')}}" class="btn btn-primary">Ver</a>

									<a href="{{action('InformeController@index')}}" class="btn btn-danger">Eliminar</a>
								</td>

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
 <script src="{{asset('js/role-script.js')}}"></script>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
 <script type="text/javascript" src="dist/js/multiselect.min.js"></script>



 <script type="text/javascript">
 $(document).ready(function() {
     // make code pretty
     window.prettyPrint && prettyPrint();

     $('.multiselect').multiselect();
 });
 </script>
@endsection
