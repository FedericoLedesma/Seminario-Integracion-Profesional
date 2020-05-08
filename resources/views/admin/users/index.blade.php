@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Usuarios</li>
@endsection
@section('titulo')
USUARIOS REGISTRADOS
@endsection
@section('content')

@include('layouts.error')


<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<form method="get" action={{ route('users.create') }}>

		<button class="btn btn-primary" type="submit">Agregar usuario</button>


</form>
<div>
	<p>
		<span id="users-total">
			<!-- Aca deben in el todal de usuarios -->
			<!-- {{$users_total}} usuarios registrados -->
		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" class="alert alert-info">Usuarios con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<div class="container">
    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">

				 {!!Form::open(['route'=>'users.index','method'=>'GET']) !!}
          <div class="input-group mb-3">

          <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
            <option value="busqueda_id" >ID</option>
            <option value="busqueda_dni" >DNI</option>
            <option value="busqueda_name" >Nombre</option>
          </select>

            {!!	Form::text('userid',null,['id'=>'userid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
            <div class="input-group-append">
							{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
            </div>
          </div>
					{!! Form::close() !!}

					<table class="table table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">id</th>
								<th scope="col">DNI</th>
								<th scope="col">Nombre</th>
								<th scope="col">Rol</th>
								<th scope="col">Creado</th>
								<th scope="col">Actualizado</th>
								<th scope="col">Accion</th>
								<th scope="col"></th>

							</tr>
						</thead>
						<tbody>
						@if($users)
							@foreach($users as $user)
							<tr>
								<td>{{$user->id}}</td>
								<td>{{$user->dni}}</td>
								<td>{{$user->name}}</td>
								<?php
								$roles=$user->getRoleNames();
								?>
								@foreach($roles as $rol)
								<td>{{$rol}}</td>
								@endforeach
								<td>{{$user->created_at}}</td>
								<td>{{$user->updated_at}}</td>
								<td>{!!link_to_route('users.show', $title = 'VER', $parameters = [$user],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								{!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method'=> 'DELETE'])!!}
                  @if(!($user->id==1))
  								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $user->id }}">Eliminar</button></td>
  								<!--  <td>{!!	Form::submit('ELIMINAR')!!}</td>-->
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
 <script src="{{asset('js/user-script.js')}}"></script>

@endsection
