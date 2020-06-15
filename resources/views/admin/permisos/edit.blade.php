@extends('layouts.plantilla')
@section('titulo')
Editar permiso
@endsection
@section('content')

	 {!! Form::model($permission, ['route' => ['permisos.update', $permission->id], 'method'=> 'PUT'])!!}
	 	@if($permission)
	    <h3>Permiso  {{$permission->name}}</h3>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    	<td>
		    {!!	Form::label('id', 'ID')!!}
		    </td>
		    <td>
		   	{!!	Form::label($permission->id)!!}
		   	</td>
		   	</tr>

		   	<tr>
	    	<td>
		    {!!	Form::label('name', 'NOMBRE')!!}
		    </td>
		    <td>
		   	{!!	Form::text('name',$permission->name)!!}
		   	</td>
		   	</tr>
		   	<tr>
	    	<td>
		     <td>{!!Form::submit('Guardar')!!}
		    </td>

		   	</tr>
		 </table>
		 @endif


@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		 document.getElementById("nav-permisos").setAttribute("class", "nav-link active");
		});
</script>
@endsection
