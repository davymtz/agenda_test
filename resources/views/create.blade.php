@extends('app.layout')
@section('title','Crear')

@section('content')
<section>
  <h1>Dar de alta a usuario</h1>
  @if($errors->any())
  <div class="alert alert-danger alert-dismissble" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <ul>
      @foreach($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form class="" action="/contacto" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
      <div class="form-group col-md-12">
        <label for="preview">Vista previa</label>
        <img src="{{asset('images/perfil.png')}}" width="150" id="preview" class="img-fluid" alt="preview">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nombre">Nombre(s) *</label>
        <input type="text" placeholder="Nombre(s)" class="form-control" id="nombre" maxlength="50" name="nombre" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="ap_paterno">Apellido Paterno *</label>
        <input type="t" placeholder="Apellido Paterno" name="ap_paterno" id="ap_paterno" maxlength="40" class="form-control" autocomplete="off">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="ap_materno">Apellido Materno</label>
        <input type="text" placeholder="Apellido Materno" name="ap_materno" id="ap_materno" maxlength="40" class="form-control" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="dateOfBirth">Fecha de nacimiento</label>
        <input type="date" placeholder="Fecha de nacimiento" name="dateOfBirth" id="dateOfBirth" class="form-control" autocomplete="off">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="alias">Alias</label>
        <input type="text" placeholder="Alias" name="alias" id="alias" class="form-control" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="">Photo</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text">Subir foto</span></div>
          <div class="custom-file">
            <input type="file" accept="image/png" class="custom-file-input" name="photo" id="photo">
            <label for="photo" class="custom-file-label">Escoge archivo</label>
          </div>
        </div>
      </div>
    </div>
    <div class="form-row" style="display: flex; justify-content: space-around;">
      <input type="submit" class="btn btn-default" name="update" value="Crear">
      <a href="/contacto" class="btn btn-danger">Cancelar</a>
    </div>
  </form>
</section>
@endsection
@section('javascript')
<script type="text/javascript">
function readImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#preview').attr('src', e.target.result); // Renderizamos la imagen
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#photo").change(function (){readImage(this);});
</script>
@endsection
