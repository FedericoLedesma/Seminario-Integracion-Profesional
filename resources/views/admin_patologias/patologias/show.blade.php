@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('patologias.index') }}">Patologias</a></li>
		<li class="breadcrumb-item active">Ver Patologia</li>
@endsection
@section('content')

	  @include('layouts.error')
	  @if($patologia)
	    <div class="table-responsive">
	      <h2>Patologia:  {{$patologia->name}}</h2>
        <div class="col-md-6 col-md-offset-1">
          <div class="panel-heading">
	          <table class="table table-bordered table-hover table-striped">
	    	      <tr>
	    		      <td>ID </td>
				        <td>{{$patologia->id}}</td>
			        </tr>
              <tr>
        				<td>Tipo Patologia </td>
        				<td>{{$patologia->tipo_patologia_id}}</td>
        			</tr>
              <tr>
        				<td>Nombre </td>
        				<td>{{$patologia->name}}</td>
        			</tr>
              <tr>
        				<td>Descripcion </td>
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
        				<td>CREADO </td>
        				<td>{{$patologia->created_at}}</td>
        			</tr>
        			<tr>
        				<td>MODIFICADO </td>
        				<td>{{$patologia->updated_at}}</td>
        			</tr>
		        </table>
		      </div>
		    </div>
		  </div>
	{!!link_to_route('patologias.edit', $title = 'MODIFICAR', $parameters = [$patologia],['class' => 'btn btn-warning'], $attributes = [])!!}




@endif
@endsection
