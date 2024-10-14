@extends('plantilla')
@section('contenido')
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white">Edita el tipo de mascota </div>
                    <div class="card-body">
                        <form id="frmTipos" method="POST" action="{{url("tipos",[$tipo])}}">
                            @method('PUT')
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-shield-dog"></i></span>
                                <input type="text" name="tipo" value="{{ $tipo->tipo}}" class="form-control" maxlength="50" placeholder="Añade un nuevo tipo de mascota" required>
                            </div>
                            <div class="d-grid col-6 mx-auto">
                                <button class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i>  Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection