@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('patologias.index') }}">Tipos de Patologías</a></li>
		<li class="breadcrumb-item active">Editar tipo de Patología</li>
@endsection
@section('titulo')
  Editar Tipo Patología
@endsection
@section('content')

	 	{!! Form::model($tipoPatologia, ['route' => ['tipospatologias.update', $tipoPatologia->id], 'method'=> 'PUT'])!!}
	 	@if($tipoPatologia)
	    <h4>  {{$tipoPatologia->name}}</h4>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
        <tr>
	    		<td>ID </td>
				<td>{{$tipoPatologia->id}}</td>
  			</tr>
                <tr>
  				<td>Nombre </td>
  				<td>{!!	Form::text('name',$tipoPatologia->name)!!}</td>
  			</tr>
        <tr>
          <td>Descripcion </td>
          <td>{!!	Form::text('observacion',$tipoPatologia->observacion)!!}</td>
        </tr>
		   	<tr>
	    	<td>
		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
		    </td>
        </tr>
        <tr>
		    <td>
		   	{!!link_to_route('tipospatologias.show', $title = 'CANCELAR', $parameters = [$tipoPatologia], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif

		</div>
		</div>
@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
   document.getElementById("nav-tipospatologias").setAttribute("class", "nav-link active");
   document.getElementById("nav-patologias").setAttribute("class", "nav-link active");
   });
</script>
@endsection
