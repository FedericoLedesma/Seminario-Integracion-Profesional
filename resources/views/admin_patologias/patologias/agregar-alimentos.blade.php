@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('patologias.index') }}">Patologias</a></li>
		<li class="breadcrumb-item active">Editar Patologia</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($patologia, ['route' => ['patologias.update', $patologia->id], 'method'=> 'PUT'])!!}
	 	@if($patologia)
	    <h1>Agregar Alimentos Prohibidos a Patologia  {{$patologia->name}}</h1>
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
			 <table class="table table-striped table-hover ">
				 <tr>
				 	<td><a href="" class="btn btn-success agregar" data-id="{{$patologia->id}}" >Agregar</a></td>
					<td><a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create">
					    Crear Alimento
					</a></td>
				 </tr>
			 </table>

       <h4>Alimentos prohibidos agregados</h4>
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
		   Presione "Editar Patologia" para quitar alimentos prohibidos.
		 </div>
		 <table class="table table-striped table-hover ">
			 <tr>
			 	<td>{!!link_to_route('patologias.edit', $title = 'Editar Patologia', $parameters = [$patologia], $attributes = ['class'=>'btn btn-success'])!!}</td>
				<td>{!!link_to_route('patologias.show', $title = 'Volver', $parameters = [$patologia], $attributes = ['class'=>'btn btn-warning'])!!}</td>
			 </tr>
		 </table>

		</div>
		</div>
    <div class="col-md-6 col-md-offset-6">

  </div>

	<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
							<h4>Crear Alimento</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>

            </div>
            <div class="modal-body">
							<table>
								<tr>
									<td>
											{!!	Form::label('name', 'Nombre')!!}
									</td>
									<td>
										<input type="text" id="nameAlimento" name="name">
									</td>
								</tr>
							</table>

            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-primary nuevoAlimento" >Guardar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
 <script src="{{asset('js/patologia-script.js')}}"></script>
 <script type="text/javascript">
 	$(document).ready(function(){
 		 document.getElementById("nav-patologias").setAttribute("class", "nav-link active");
 		});
 </script>
@endsection
