@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('patologias.index') }}">Patologias</a></li>
		<li class="breadcrumb-item active">Editar Patologia</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	 	{!! Form::model($tipoPatologia, ['route' => ['tipospatologias.update', $tipoPatologia->id], 'method'=> 'PUT'])!!}
	 	@if($tipoPatologia)
	    <h1>Editar Tipo Patologia  {{$tipoPatologia->name}}</h1>
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
