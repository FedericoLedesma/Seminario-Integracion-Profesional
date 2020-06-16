@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('alimentos.index') }}">Alimentos</a></li>
		<li class="breadcrumb-item active">Ver Alimento</li>
@endsection
@section('titulo')
  Ver alimento
@endsection
@section('content')

	   @include('layouts.error')
	  	@if($alimento)
	    <div class="table-responsive">
	    <h4>Alimento:  {{$alimento->name}}</h4>
        <div class="col-md-6 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$alimento->id}}</td>
			</tr>
      <tr>
				<td>Nombre </td>
				<td>{{$alimento->name}}</td>
			</tr>
      <tr>
				<td>CREADO </td>
				<td>{{$alimento->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$alimento->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('alimentos.edit', $title = 'MODIFICAR', $parameters = [$alimento],['class' => 'btn btn-warning'], $attributes = [])!!}




@endif
@endsection
@section('script')
  <script type="text/javascript">
  	$(document).ready(function(){
  		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
  		document.getElementById("nav-alimentos").setAttribute("class","nav-link active");
  		});
  </script>
@endsection
