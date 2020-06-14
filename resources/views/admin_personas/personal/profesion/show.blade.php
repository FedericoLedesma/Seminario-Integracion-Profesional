@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('profesion.index') }}">Profesiones</a></li>
		<li class="breadcrumb-item active">Ver profesión</li>
@endsection
@section('content')

	   @include('layouts.error')
	  	@if($profesion)
	    <div class="table-responsive">
	    <h2>Profesion:  {{$profesion->id}}</h2>
        <div class="col-md-5 col-md-offset-0">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    <td>Nombre </td>
				<td>{{$profesion->get_name()}}</td>
			</tr>
      <tr>
				<td>CREADO </td>
				<td>{{$profesion->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$profesion->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('profesion.edit', $title = 'MODIFICAR', $parameters = [$profesion->id],['class' => 'btn btn-warning'], $attributes = [])!!}




@endif
@endsection
@section('script')
  <script type="text/javascript">
   $(document).ready(function(){
      document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
      document.getElementById("nav-administracion-profesion").setAttribute("class", "nav-link active");
     });
  </script>
@endsection
