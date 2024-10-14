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
        let lbl_tipo = document.querySelector('#lbl_tipo');
        window.setInfo = function(id, tipo) {
            btnEliminar.setAttribute('data-id', id);
            lbl_tipo.innerHTML = 'Eliminarás la mascota: <b>' + tipo + '</b>';
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
                        <th>Tipo</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php $i=1; @endphp
                    @foreach ($tipos as $row)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $row->tipo }}</td>
                            <td>
                                <a href="{{ url('tipos',[$row])}}" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <form id="frm_{{$row->id}}" method="POST" action="{{ url('tipos',[$row]) }}">
                                @method("delete")
                                @csrf
                                <button data-bs-toggle="modal" data-bs-target="#modalConfirmacion" onclick="setInfo({{$row->id}},'{{$row->tipo}}')"
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
            <label id="lbl_tipo"></label></p>
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
                <label class="h5" id="titulo_modal">Añadir tipo</label>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmTipos" method="POST" action="{{url("tipos")}}">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-shield-dog"></i></span>
                    <input type="text" name="tipo" class="form-control" maxlength="50" placeholder="Añade un nuevo tipo de mascota" required>
                </div>
                <div class="d-grid col-6 mx-auto">
                    <button class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i>  Guardar</button>
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