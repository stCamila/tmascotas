@extends('plantilla')
@section('contenido')
@if ($errors->any())
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">
            <p><b><i class="fa-solid fa-xmark"></i> Error </b></p>
            <ul>
                @foreach ($errors->all as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white">Edita a la mascota </div>               
                    <div class="card-body">
                        <form id="frmMTipos" method="POST" action="{{url("mascotas",[$mascota])}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-shield-dog"></i></span>
                                <select name="id_tipo" class="form-select" required>
                                    <option value="">Tipo de mascota</option>
                                    @foreach ($tipos as $row)
                                    @if ($row->id == $mascota->id_tipo)
                                    <option selected value="{{ $row->id}}">{{ $row->tipo}}</option>
                                    @else
                                    <option value="{{ $row->id}}">{{ $row->tipo}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-paw"></i></span>
                                <input type="text" name="raza" value="{{ $mascota->raza}}" class="form-control" maxlength="50" placeholder="Raza" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                <input type="text" name="nombre" value="{{ $mascota->nombre}}" class="form-control" maxlength="50" placeholder="Nombre" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-shield-heart"></i></span>
                                <input type="text" name="cuidados" value="{{ $mascota->cuidados}}" class="form-control" maxlength="50" placeholder="Cuidados" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-regular fa-calendar"></i></span>
                                <input type="date" name="fecha_nacimiento" value="{{ $mascota->fecha_nacimiento}}" class="form-control" maxlength="50" placeholder="Fecha de acimiento" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                                <input type="text" name="precio" value="{{ $mascota->precio}}" class="form-control" maxlength="50" placeholder="Precio" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-regular fa-image"></i></span>
                                <input type="file" name="foto" value="{{ $mascota->foto}}" class="form-control" maxlength="50" @if(!isset($mascota)) required @endif accept="image/*">
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