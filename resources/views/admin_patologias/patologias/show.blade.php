@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('patologias.index') }}">Patologias</a></li>
		<li class="breadcrumb-item active">Ver Patologia</li>
@endsection
@section('titulo')
  Ver patología
@endsection
@section('content')

	  @include('layouts.error')
	  @if($patologia)
	    <div class="table-responsive">
	      <h4>Patología:  {{$patologia->name}}</h4>
        <div class="col-md-6 col-md-offset-1">
          <div class="panel-heading">
	          <table class="table table-bordered table-hover table-striped">
	    	      <tr>
	    		      <td>ID </td>
				        <td>{{$patologia->id}}</td>
			        </tr>
              <tr>
        				<td>Tipo de patología </td>
        				<td>@if($patologia->tipoPatologia)
								{{$patologia->tipoPatologia->name}}
							@endif
						</td>
        			</tr>
              <tr>
        				<td>Nombre </td>
        				<td>{{$patologia->name}}</td>
        			</tr>
              <tr>
        				<td>Descripción </td>
        				<td>{{$patologia->descripcion}}</td>
        			</tr>
              <tr>
        				<td>Alimentos prohibidos</td>
        				<td>@foreach ($patologia->alimentos as $alimento)
                    {{$alimento->name}} ;</br>
                    @endforeach
                </td>
        			</tr>
        			<tr>
        				<td>Creado </td>
        				<td>@if($patologia->created_at){{date("d/m/Y H:i:s", strtotime($patologia->created_at))}}@endif</td>
        			</tr>
        			<tr>
        				<td>Modificado </td>
        				<td>@if($patologia->updated_at){{date("d/m/Y H:i:s", strtotime($patologia->updated_at))}}@endif</td>
        			</tr>
		        </table>
		      </div>
		    </div>
		  </div>
	{!!link_to_route('patologias.edit', $title = 'Modificar', $parameters = [$patologia],['class' => 'btn btn-warning'], $attributes = [])!!}

@endif
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		 document.getElementById("nav-patologias").setAttribute("class", "nav-link active");
		});
</script>
@endsection
