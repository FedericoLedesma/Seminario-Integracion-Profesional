@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('tipospatologias.index') }}">Tipos de Patologias</a></li>
		<li class="breadcrumb-item active">Ver Tipo de Patologia</li>
@endsection
@section('titulo')
  Ver tipo de patología
@endsection
@section('content')

	   @include('layouts.error')
	  	@if($tipoPatologia)
	    <div class="table-responsive">
	    <h4>Tipo de Patologia:  {{$tipoPatologia->name}}</h4>
        <div class="col-md-3 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$tipoPatologia->id}}</td>
			</tr>
      <tr>
				<td>Nombre </td>
				<td>{{$tipoPatologia->name}}</td>
			</tr>
      <tr>
				<td>Observacion </td>
				<td>{{$tipoPatologia->observacion}}</td>
			</tr>
			<tr>
				<td>CREADO </td>
				<td>@if($tipoPatologia->created_at){{date("d/m/Y H:i:s", strtotime($tipoPatologia->created_at))}}@endif</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>@if($tipoPatologia->updated_at){{date("d/m/Y H:i:s", strtotime($tipoPatologia->updated_at))}}@endif</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
    {!!link_to_route('tipospatologias.edit', $title = 'MODIFICAR', $parameters = [$tipoPatologia],['class' => 'btn btn-warning'], $attributes = [])!!}




@endif
@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
   document.getElementById("nav-tipospatologias").setAttribute("class", "nav-link active");
   document.getElementById("nav-patologias").setAttribute("class", "nav-link active");
   });
</script>
@endsection
