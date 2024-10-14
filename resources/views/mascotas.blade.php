@extends('plantilla')
@section('contenido')
@if ($msj = Session::get('success'))
    <div class="row">
        <div id="success-message" class="col-md-4 offset-md-4">
            <div class="alert alert-success">
                <p><i class="fa-solid fa-check"></i>{{$msj}}</p>
            </div>
        </div>
    </div>
@endif
<script>
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 2000);

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let btnEliminar = document.querySelector('#btnEliminar');
        let lbl_nombre = document.querySelector('#lbl_nombre');
        window.setInfo = function(id, nombre) {
            btnEliminar.setAttribute('data-id', id);
            lbl_nombre.innerHTML = 'Eliminarás la mascota: <b>' + nombre + '</b>';
        };
        btnEliminar.addEventListener('click', function () {
            let id = btnEliminar.getAttribute('data-id');
            let form = document.querySelector('#frm_' + id);
            form.submit(); 
        });
    });
</script>

    <div class="row mt-3">
        <div class="col-md-4 offset-md-4">
            <div class="d-grid mx-auto">
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target='#modalTipos'>
                <i class="fa-solid fa-plus"></i> Añadir
            </button>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12 col-lg-8 offset-0 offset-lg-2">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>id tipo</th>
                        <th>Raza</th>
                        <th>Nombre</th>
                        <th>Cuidados</th>
                        <th>Fecha de nacimiento</th>
                        <th>Precio</th>
                        <th>Foto</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php $i=1; @endphp
                    @foreach ($mascotas as $row)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $row->tipo }}</td>
                            <td>{{ $row->raza }}</td>
                            <td>{{ $row->nombre }}</td>
                            <td>{{ $row->cuidados }}</td>
                            <td>{{ $row->fecha_nacimiento }}</td>
                            <td>{{ $row->precio }}</td>
                            <td>
                                <img class="img-fluid" width="120" src="{{ asset('storage/' . $row->foto) }}">

                            </td>
                            <td>
                                <a href="{{ url('mascotas',[$row])}}" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <form id="frm_{{$row->id}}" method="POST" action="{{ url('mascotas',[$row]) }}">
                                    @method("delete")
                                    @csrf
                                    <button data-bs-toggle="modal" data-bs-target="#modalConfirmacion" onclick="setInfo({{$row->id}},'{{$row->nombre}}')"
                                        type="button" class="btn btn-danger">
                                    <i class="fa-regular fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="modalConfirmacion">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">¿Seguro que quieres eliminar?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><i class="fa-solid fs-3 text-warning fa-triangle-exclamation"></i>
            <label id="lbl_nombre"></label></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button id="btnEliminar" type="button" class="btn btn-success">Sí, eliminar</button>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="modalTipos" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label class="h5" id="titulo_modal">Añade una Mascota</label>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmMTipos" method="POST" action="{{url("mascotas")}}" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-shield-dog"></i></span>
                    <select name="id_tipo" class="form-select" required>
                        <option value="">Tipo de mascota</option>
                        @foreach ($tipos as $row)
                        <option value="{{ $row->id}}">{{ $row->tipo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-paw"></i></span>
                    <input type="text" name="raza" class="form-control" maxlength="50" placeholder="Raza" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                    <input type="text" name="nombre" class="form-control" maxlength="50" placeholder="Nombre" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-shield-heart"></i></span>
                    <input type="text" name="cuidados" class="form-control" maxlength="50" placeholder="Cuidados" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-regular fa-calendar"></i></span>
                    <input type="date" name="fecha_nacimiento" class="form-control" maxlength="50"  placeholder="Fecha de nacimiento" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                    <input type="number" name="precio" class="form-control" maxlength="50" placeholder="Precio" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-regular fa-image"></i></span>
                    <input type="file" name="foto" class="form-control" required accept=" image/*">
                </div>
                <div class="d-grid col-6 mx-auto">
                    <button class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Guardar</button>
                </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection