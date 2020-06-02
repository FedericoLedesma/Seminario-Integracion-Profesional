
<select class="browser-default custom-select" id="racion" name="racion">
@if($raciones)
  @foreach($raciones as $racion)
    <option value={{$racion->id}}> {{$racion->id}}</option>
  @endforeach
@else
  <option value=0 > No hay raciones disponibles </option>
@endif
</select>
