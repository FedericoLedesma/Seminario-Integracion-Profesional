@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('raciones.index') }}">Raciones</a></li>
		<li class="breadcrumb-item active">Editar Racion</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($racion, ['route' => ['raciones.update', $racion->id], 'method'=> 'PUT'])!!}
	 	@if($racion)
	    <h1>Agregar Alimentos a Racion  {{$racion->name}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-6 col-md-offset-1">
	 			@endif
				{!!	Form::label('lbl',"Buscar Alimento")!!}
     <div class="input-group mb-3">

     <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
       <option value="busqueda_id" >ID</option>
       <option value="busqueda_name" >Nombre</option>
     </select>

       {!!	Form::text('alimentoid',null,['id'=>'alimentoid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
       <div class="input-group-append">
        <td><a href="" class="btn btn-success buscar">Buscar</a></td>
       </div>

       <table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
         <thead >
           <tr>
             <th scope="col">Nombre</th>
           </tr>
         </thead>
         <tbody id="tablealimentos">

         </tbody>

       </table>
       <div class="input-group mb-3">
         <a href="" class="btn btn-success agregar" data-id="{{$racion->id}}" >Agregar</a>
       </div>
       <h4>Alimentos agregados</h4>
       <table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
         <thead >
           <tr>
             <th scope="col">Nombre</th>
           </tr>
         </thead>
         <tbody id="tablealimentosAgregados">

         </tbody>
       </table>

     </div>

		 <div class="alert alert-info" role="alert">
		   Presione "Editar Racion" para quitar alimentos y/o establecer cantidades.
		 </div>
		 <table class="table table-striped table-hover ">
			 <tr>
			 	<td>{!!link_to_route('raciones.edit', $title = 'Editar Racion', $parameters = [$racion], $attributes = ['class'=>'btn btn-success'])!!}</td>
				<td>{!!link_to_route('raciones.show', $title = 'Volver', $parameters = [$racion], $attributes = ['class'=>'btn btn-warning'])!!}</td>
			 </tr>
		 </table>

		</div>
		</div>
    <div class="col-md-6 col-md-offset-6">

  </div>
@endsection
@section('script')
 <script src="{{asset('js/racion-script.js')}}"></script>

@endsection
