@extends('app.layout')
@section('title','Inicio')

@section('content')
<section>
  @if(session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  <div class="row">
    <div class="col-md-8">
      <h1 class="text-center">Contactos</h1>
    </div>
    <div class="col-md-4">
      <a href="/contacto/create" class="btn btn-success" style="margin-top: 0.5em;">Crear contacto</a>
    </div>
  </div>
  <table class="table table-hovered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>Nombre(s)</th>
        <th>Apellido Paterno</th>
        <th>Fecha de nacimiento</th>
        <th>Alias</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @if(count($contactos) > 0)
      @foreach($contactos as $contacto)
      <tr>
        <td>{{$contacto->nombre}}</td>
        <td>{{$contacto->ap_paterno}}</td>
        <td>{{Carbon\Carbon::parse($contacto->dateOfBirth)->format('d/m/Y')}}</td>
        <td>{{$contacto->alias}}</td>
        <td style="display: inline-flex;">
          <a href="/contacto/{{$contacto->id}}/edit" type="button" class="btn btn-primary" style="margin-right: 0.5em;" name="button"><i class="far fa-edit"></i></a>
          <form action="/contacto/{{$contacto->id}}" id="delete_{{$contacto->id}}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" data-id="{{$contacto->id}}" class="btn btn-danger btn-delete" name="button">
              <i class="far fa-trash"></i>
            </button>
          </form>
        </td>
      </tr>
      @endforeach
      @else
      <tr><td colspan="5" class="text-center">No hay resultados</td></tr>
      @endif
    </tbody>
  </table>
</section>
@endsection

@section('javascript')
<script type="text/javascript">
$(".btn-delete").click(e => {
  e.preventDefault();
  let $id = e.currentTarget.getAttribute("data-id");
  if(confirm('Está seguro que desea eliminar el contacto?')) {
    document.getElementById('delete_'+$id).submit();
  }
});
</script>
@endsection
