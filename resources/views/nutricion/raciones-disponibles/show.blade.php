@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('raciones-disponibles.index') }}">Raciones Disponibles</a></li>
		<li class="breadcrumb-item active">Ver Racion</li>
@endsection
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
<style>
<!--
	.table-resposive{
		float:left;
	}

-->
</style>
	   @include('layouts.error')
     <div id="alert" class="alert alert-info"></div>
	  	@if($racionDisponible)
	    <div class="table-responsive">
        <div class="col-md-6 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>Racion </td>
				<td>{{$racionDisponible->horario_racion->racion->name}}</td>
			</tr>
      <tr>
				<td>Horario </td>
				<td>{{$racionDisponible->horario_racion->horario->name}}</td>
			</tr>
      <tr>
				<td>Fecha </td>
				<td>{{$racionDisponible->fecha()}}</td>
			</tr>
      <tr>
        <td>Stock </td>
        <td id="td-stock">{{$racionDisponible->stock_original}}</td>
      </tr>
      <tr>
        <td id="td-restantes">Restantes </td>
        <td>{{$racionDisponible->cantidad_restante}}</td>
      </tr>
      <tr>
        <td id="td-realizados">Realizados </td>
        <td>{{$racionDisponible->cantidad_realizados}}</td>
      </tr>
      <tr>
      <td><a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create-stock">
          Agregar Stock
      </a></td>
    
      </tr>
		</table>
		</div>
		</div>
		</div>


  <div class="modal fade" id="create-stock">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
							<h4>Agregar cantidad al stock</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>

            </div>
            <div class="modal-body">
							<table>
								<tr>
									<td>
											{!!	Form::label('cantidad', 'Cantidad Stock')!!}
									</td>
									<td>
										<input type="number" id="cantidad_stock" name="cantidad_stock" min="0" step="1">
									</td>
								</tr>
							</table>

            </div>
            <div class="modal-footer">
                <a href="" data-id="{{$racionDisponible}}" data-user={{Auth::user()}} class="btn btn-primary guardarStock" >Guardar</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create-realizados">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4>Agregar Cantidad de Realizados</h4>
              <button type="button" class="close" data-dismiss="modal">
                  <span>×</span>
              </button>

          </div>
          <div class="modal-body">
            <table>
              <tr>
                <td>
                    {!!	Form::label('cantidad_realizados', 'Cantidad Realizados')!!}
                </td>
                <td>
                  <input type="number" id="cantidad_realizados" name="cantidad_realizados" min="0" max="{{$racionDisponible->cantidad_restante}}" step="1">
                </td>
              </tr>
            </table>

          </div>
          <div class="modal-footer">
              <a href="" data-id="{{$racionDisponible}}"  data-user={{Auth::user()}} class="btn btn-primary guardarRealizados" >Guardar</a>
          </div>
      </div>
  </div>
</div>



@endif
@endsection
@section('script')
 <script src="{{asset('js/racion-disponibles-script.js')}}"></script>
@endsection
