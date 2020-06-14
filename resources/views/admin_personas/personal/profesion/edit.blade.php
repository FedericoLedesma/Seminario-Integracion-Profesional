@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('profesion.index') }}">Profesiones</a></li>
		<li class="breadcrumb-item active">Editar profesión</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($profesion, ['route' => ['profesion.update', $profesion->id], 'method'=> 'PUT'])!!}
	 	@if($profesion)
	    <h1>Editar habitación:  {{$profesion->name}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
        <tr>
	    		<td>ID </td>
				<td>{{$profesion->id}}</td>
  			</tr>
        <tr>
  				<td>Nombre </td>
  				<td>{!!	Form::text('name',$profesion->name)!!}</td>
  			</tr>
		   	<tr>
  		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
  		    </td>
        </tr>
        <tr>
		    <td>
		   	{!!link_to_route('profesion.show', $title = 'CANCELAR', $parameters = [$profesion->id], $attributes = [])!!}
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
      document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
      document.getElementById("nav-administracion-profesion").setAttribute("class", "nav-link active");
     });
  </script>
@endsection
