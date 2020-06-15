@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Roles</li>
@endsection
@section('titulo')
ROLES REGISTRADOS
@endsection
@section('content')

	  	<title>PAGINA PRINCIPAL ADMINISTRADOR</title>

	      @include('layouts.error')

<form method="get" action={{ route('roles.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Rol</button>


</form>
<div>
	<p>
		<span id="users-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-roles" class="alert alert-info">Roles con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-auto col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">
				 {!!Form::open(['route'=>'roles.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_id" >ID</option>
						 <option value="busqueda_name" >Nombre</option>
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
								<th scope="col">ID</th>
								<th scope="col">Nombre</th>
								<th scope="col">Creado</th>
								<th scope="col">Actualizado</th>
								<th scope="col">Acción</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($roles)
							@foreach($roles as $role)
							<tr>
								<td>{{$role->id}}</td>
								<td>{{$role->name}}</td>
								<td>{{$role->created_at}}</td>
								<td>{{$role->updated_at}}</td>
								<td>{!!link_to_route('roles.show', $title = 'VER', $parameters = [$role],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								{!! Form::model($role, ['route' => ['roles.destroy', $role->id], 'method'=> 'DELETE'])!!}
								@if(!($role->id==1))
								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $role->id }}">Eliminar</button></td>
								@endif
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
 	<script type="text/javascript">
 		$(document).ready(function(){
 			 document.getElementById("nav-roles").setAttribute("class", "nav-link active");
 			 document.getElementById("nav-roles-todos").setAttribute("class", "nav-link active");
 			});
 	</script>

@endsection
