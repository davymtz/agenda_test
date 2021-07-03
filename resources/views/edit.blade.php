@extends('app.layout')
@section('title','Editar')

@section('content')
<section>
  <h1>Editar información de <b>"{{$contacto->nombre}} {{$contacto->ap_paterno}}"</b></h1>
  <span>* Campos requeridos</span>
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
  <form class="" action="/contacto/{{$contacto->id}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" id="id_user" value="{{$contacto->id}}">
    <div class="form-row">
      <div class="form-group col-md-12">
        <label for="preview">Vista previa</label>
        <img src="@if($url !== null){{asset($url)}}@else{{asset('images/perfil.png')}}@endif" width="150" id="preview_update" class="img-fluid" alt="preview">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nombre">Nombre(s) *</label>
        <input type="text" placeholder="Nombre(s)" class="form-control" id="nombre" name="nombre" value="{{$contacto->nombre}}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="ap_paterno">Apellido Paterno *</label>
        <input type="text" placeholder="Apellido Paterno" name="ap_paterno" id="ap_paterno" class="form-control" value="{{$contacto->ap_paterno}}" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="ap_materno">Apellido Materno</label>
        <input type="text" placeholder="Apellido Materno" name="ap_materno" id="ap_materno" class="form-control" value="{{$contacto->ap_materno}}">
      </div>
      <div class="form-group col-md-6">
        <label for="dateOfBirth">Fecha de nacimiento</label>
        <input type="date" placeholder="Fecha de nacimiento" name="dateOfBirth" id="dateOfBirth" class="form-control" value="{{$contacto->dateOfBirth}}">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="alias">Alias</label>
        <input type="text" placeholder="Alias" size="10" name="alias" id="alias" class="form-control" value="{{$contacto->alias}}">
      </div>
      <div class="form-group col-md-4">
        <label for="">Photo</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text">Subir foto</span></div>
          <div class="custom-file">
            <input type="file" accept="image/png" class="custom-file-input" name="photo_update" id="photo_update">
            <label for="photo" class="custom-file-label">Escoge archivo</label>
          </div>
        </div>
      </div>
      <div class="form-group col-md-2">
        <label for=""></label>
        <button type="button" class="btn btn-danger form-control" id="button_delete_image" name="button_delete_image">Eliminar foto</button>
      </div>
    </div>
    <div class="form-row" style="display: flex; justify-content:space-around;">
      <input type="submit" class="btn btn-default" name="update" value="Actualizar">
      <a href="/contacto" class="btn btn-primary">Regresar</a>
    </div>
  </form>
  <hr />
  <div class="row">
    <div class="col">
      <div class="row">
        <div class="col-md-8"><h3>Números</h3></div>
        <div class="col-md-4">
          <button type=button class="btn btn-success" data-toggle="modal" data-target="#add_number" style="margin-top: 0.5em;">&plus;</button>
        </div>
      </div>
      <table class="table table-condensed">
        <thead class="thead-light">
          <tr>
            <th>Etiqueta</th>
            <th>Número de telefóno</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contacto->phones as $phone)
          <tr>
            <td>{{$phone->tag}}</td>
            <td>{{$phone->phone}}</td>
            <td>
              <button type="button" onclick="getDataNumber({{$phone->id}});" class="btn btn-primary" name="button" data-toggle="modal" data-target="#edit_number"><i class="far fa-edit"></i></button>
              <button type="button" data-id="{{$phone->id}}" class="btn btn-danger btn_delete_phone" name="button"><i class="far fa-trash"></i></button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="col">
      <div class="row">
        <div class="col-md-8"><h3>Correos</h3></div>
        <div class="col-md-4">
          <button type=button class="btn btn-success" data-toggle="modal" data-target="#add_email" style="margin-top: 0.5em;">&plus;</button>
        </div>
      </div>
      <table class="table table-condensed">
        <thead class="thead-light">
          <tr>
            <th>Correo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contacto->emails as $email)
          <tr>
            <td>{{$email->email}}</td>
            <td>
              <button type="button" onclick="getDataEmail({{$email->id}});" class="btn btn-primary" name="button" data-toggle="modal" data-target="#edit_email"><i class="far fa-edit"></i></button>
              <button type="button" data-id="{{$email->id}}" class="btn btn-danger btn_delete_email" name="button"><i class="far fa-trash"></i></button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="row">
        <div class="col-md-8"><h3>Direcciones</h3></div>
        <div class="col-md-4">
          <button type=button class="btn btn-success" data-toggle="modal" data-target="#add_address" style="margin-top: 0.5em;">&plus;</button>
        </div>
      </div>
      <table class="table table-condensed">
        <thead class="thead-light">
          <tr>
            <th>Dirección</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contacto->address as $addres)
          <tr>
            <td>{{$addres->address}}</td>
            <td>
              <button type="button" onclick="getDataAddress({{$addres->id}});" class="btn btn-primary" name="button" data-toggle="modal" data-target="#edit_address"><i class="far fa-edit"></i></button>
              <button type="button" data-id="{{$addres->id}}" class="btn btn-danger btn_delete_address" name="button"><i class="far fa-trash"></i></button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <!-- Phones -->
  @include('phones.add_number') @include('phones.edit_number')
  <!-- Emails -->
  @include('emails.add_email') @include('emails.edit_email')
  <!-- Address -->
  @include('address.add_address') @include('address.edit_address')
</section>
@endsection

@section('javascript')
<script type="text/javascript">
function readImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#preview_update').attr('src', e.target.result); // Renderizamos la imagen
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#photo_update").change(function (){readImage(this);});
</script>
<script type="text/javascript" src="{{ asset('js/action_phones.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/action_emails.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/action_address.js') }}"></script>
<script type="text/javascript">
function errorMessage(status,response,$modal,$button) {
  element = document.querySelector($modal+' #err_message ul');
  if(element) { document.querySelector($modal+' #err_message').removeChild(element); }
  if (status == 422) {
    let ul = document.createElement('ul');
    response.forEach((value, i) => {
      let li = document.createElement('li');
      li.style.color = 'red';
      li.innerText = value;
      ul.appendChild(li);
    });
    document.querySelector($modal+' #err_message').appendChild(ul);
    $($button).text("Guardar");
    setTimeout(() => {
      element = document.querySelector($modal+' #err_message ul');
      document.querySelector($modal+' #err_message').removeChild(element);
    },3000);
  }
}
</script>
@endsection
