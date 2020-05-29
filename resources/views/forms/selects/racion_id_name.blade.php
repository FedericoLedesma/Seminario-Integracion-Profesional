
<select class="browser-default custom-select" id="racion" name="racion">
@if($racion_recomendada<>null)
  <option value={{$racion_recomendada->get_id()}} > (Recomendada) {{$racion_recomendada->get_name()}}</option>
@else
  <option value=0 > No hay raciones disponibles </option>
@endif
@foreach($raciones as $racion)
  @if($racion->get_id()<>$racion_recomendada->get_id())
  <option value={{$racion->get_id()}} >{{$racion->get_name()}}</option>
  @endif
@endforeach
</select>
