<select id="habitacion_id" class="browser-default custom-select" name="habitacion_id">
  @foreach($habitaciones as $h)
    <option value={{$h->id}} >{{$h->name}}</option>
  @endforeach
</select>
