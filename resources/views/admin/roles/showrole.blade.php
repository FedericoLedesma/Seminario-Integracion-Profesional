@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('roles.index') }}">Roles</a></li>
		<li class="breadcrumb-item active">Ver Rol</li>
@endsection
@section('titulo')
  Ver Rol
@endsection
@section('content')

	   @include('layouts.error')
	  	@if($role)




	    <div class="table-responsive">
	    <h3>Rol  {{$role->name}}</h3>
        <div class="col-md-6 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$role->id}}</td>
			</tr>
			<tr>
				<td>NOMBRE </td>
				<td>{{$role->name}}</td>
			</tr>
			<tr>
				<td>CREADO </td>
				<td>@if($role->created_at){{date("d/m/Y h:i:s", strtotime($role->created_at))}}@endif</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>@if($role->updated_at){{date("d/m/Y h:i:s", strtotime($role->updated_at))}}@endif</td>
			</tr>

		</table>

	{!!link_to_route('roles.edit', $title = 'MODIFICAR', $parameters = [$role],['class' => 'btn btn-warning'], $attributes = [])!!}

	<h3>Permisos asociados</h3>
	@if($permisos)
	<div class="table-resposive">
        <div class="panel-heading">
		    <table class="table table-bordered table-striped">
		    @foreach($permisos as $permiso)
		    	<tr>
			 		<td>
			 			<label>{{$permiso}}</label>
			 		</td>
				</tr>

				@endforeach
			</table>
		</div>
	</div>
	@endif



@endif
</div>
</div>
</div>
@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			 document.getElementById("nav-roles").setAttribute("class", "nav-link active");
			});
	</script>
@endsection
