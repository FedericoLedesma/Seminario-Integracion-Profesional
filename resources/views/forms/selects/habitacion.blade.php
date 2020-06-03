<select class="browser-default custom-select" id="habitacion_id" name="habitacion_id">
  <option value=0 >todos</option>
  @foreach($habitacion as $h)
    <option value={{$h->habitacion_id}} >{{$h->name}}</option>
  @endforeach
</select>
