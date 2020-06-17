@extends('layouts.layout')
@section('navegacion')
<li class="breadcrumb-item"><a href="{{route('users.index') }}">Usuarios</a></li>
<li class="breadcrumb-item active">User {{$user->id}}</li>
@endsection
@section('titulo')
	Ver usuario
@endsection
@section('content')
	   @include('layouts.error')
	  	@if($user)


	    <div class="table-responsive">
        <div class="col-md-6 col-md-offset-1">
	    <table class="table table-bordered table-striped">
	    	<tr>
	    		<td>ID USUARIO </td>
				<td>{{$user->id}}</td>
			</tr>
			<tr>
				<td>DNI </td>
				<td>{{$user->dni}}</td>
			</tr>
			<tr>
				<td>NOMBRE </td>
				<td>{{$user->name}}</td>
			 </tr>
			 <tr>
				<td>ROL </td>
				<?php
					$roles=$user->getRoleNames();
				?>
					@foreach($roles as $rol)
						<td>{{$rol}}</td>
					@endforeach

			</tr>
			<tr>
				<td>CREADO </td>
				<td>@if($user->created_at){{date("d/m/Y H:i:s", strtotime($user->created_at))}}@endif</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>@if($user->updated_at){{date("d/m/Y H:i:s", strtotime($user->updated_at))}}@endif</td>
			</tr>

		</table>
			@if(!($user->id==1))
				{!!link_to_route('users.edit', $title = 'MODIFICAR', $parameters = [$user],['class' => 'btn btn-warning'], $attributes = [])!!}
			@endif
		@endif
		</div>
		</div>
@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			 console.log("hola");
			 document.getElementById("nav-usuarios").setAttribute("class", "nav-link active");
			});
	</script>
@endsection
