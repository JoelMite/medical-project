@extends('layouts.panel')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@endsection

@section('content')

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Información del Usuario</h4>
                        <div class="card-header-action">
                            <a href="{{url('doctors')}}" class="btn btn-icon icon-left btn-warning"><i
                                    class="fas fa-reply"></i>
                                Volver</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user-tie"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="name" class="form-control" value="{{$person->name}}"
                                            disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user-tie"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="lastname" class="form-control"
                                            value="{{$person->lastname}}" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label>Correo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-at"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="email" class="form-control"
                                            value="{{$doctor->email}}" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{$person->phone}}" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label>Fecha de Nacimiento</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-birthday-cake"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="date_birth" class="form-control"
                                            value="{{$person->date_birth}}" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label>Ciudad</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-city"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="city" class="form-control"
                                            value="{{$person->city}}" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="address" class="form-control"
                                            value="{{$person->address}}" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label>Etnia</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-id-card-alt"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="etnia" class="form-control"
                                            value="{{$person->etnia}}" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label>Género</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-restroom"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="sex" class="form-control"
                                            value="{{$person->sex}}" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <strong>Roles</strong>
                                <br>
                                @foreach ($roles as $role)
                                    <span class="badge badge-success badge-shadow m-1">{{ $role->name }}</span>
                                @endforeach
                            </div>
                            <div class="col-md-6 col-6">
                                <strong>Especialidades</strong>
                                <br>

                                @if (sizeof($specialties) == 0)
                                 <p>No existen especialidades.</p>
                                @endif

                                @foreach ($specialties as $specialty)
                                    <span class="badge badge-primary badge-shadow m-1">{{ $specialty->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


@vite([
'resources/js/app.js',
'resources/assets/js/scripts.js',
])
@endsection