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

	    <h1>Menues de persona (planillas) existentes</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<form method="get" action={{ route('menu_persona.create') }}>

		<button class="btn btn-primary" type="submit">Agregar menu persona (planilla)</button>


</form>
<div>
	<p>
		<span id="menu_persona-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-menu_persona" class="alert alert-info">Menues persona (Planillas) con {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">
				 {!!Form::open(['route'=>'menu_persona.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_nombre_persona" >Buscar por persona</option>
						 <option value="busqueda_nombre_horario" >Buscar por horario</option>
						 <option value="busqueda_fecha" >Buscar por fecha</option>
					 </select>

						 {!!	Form::text('roleid',null,['id'=>'roleid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
						 <div class="input-group-append">
							{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
						 </div>
					 </div>
					{!! Form::close() !!}

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
						@if($menues)
							@foreach($menues as $menu_persona)
							<tr>
								{{Log::debug(' Persona id: '.$menu_persona)}}
								<td>{{$menu_persona->get_persona_nombre_completo()}}</td>
								<td>{{$menu_persona->get_horario_name()}}</td>
								<td>{{$menu_persona->get_racion_name()}}</td>
								<td>{{$menu_persona['fecha']}}</td>
								<td>{{$menu_persona->isRealizado_str()}}</td>
								
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
 <script src="{{asset('js/role-script.js')}}"></script>

@endsection
