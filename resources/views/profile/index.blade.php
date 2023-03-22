@extends('layouts.panel')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')

    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    
                    <div class="card">
                        <div class="card-header">
                            <h4>Datos Personales</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                        
                                    <span class="float-left">
                                            <i class="fas fa-user-tie"></i>
                                        Nombres
                                    </span>
                                    <span class="float-right text-muted">
                                        {{$person->name}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                        
                                    <span class="float-left">
                                            <i class="fas fa-user-tie"></i>
                                         Apellidos
                                    </span>
                                    <span class="float-right text-muted">
                                        {{$person->lastname}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        <i class="fas fa-birthday-cake"></i>
                                        Fecha de Nacimiento
                                    </span>
                                    <span class="float-right text-muted">
                                        {{$person->date_birth}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        <i class="fas fa-phone"></i>
                                        Teléfono
                                    </span>
                                    <span class="float-right text-muted">
                                        {{$person->phone}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    
                                    <span class="float-left">
                                        <i class="fas fa-at"></i>
                                        Correo
                                    </span>
                                    <span class="float-right text-muted">
                                        {{$user->email}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Dirección
                                    </span>
                                    <span class="float-right text-muted">
                                        {{$person->address}}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card">
                        <div class="padding-20">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                                        aria-selected="true">Perfil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                                        aria-selected="false">Editar Perfil</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                <div class="tab-pane fade show active" id="about" role="tabpanel"
                                    aria-labelledby="home-tab2">
                                    <div class="row">
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>Nombres y Apellidos</strong>
                                            <br>
                                            <p class="text-muted">{{$person->name}} {{$person->lastname}}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>Teléfono</strong>
                                            <br>
                                            <p class="text-muted">{{$person->phone}}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r">
                                            <strong>Correo</strong>
                                            <br>
                                            <p class="text-muted">{{$user->email}}</p>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <strong>Dirección</strong>
                                            <br>
                                            <p class="text-muted">{{$person->address}}</p>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <strong>Ciudad</strong>
                                            <br>
                                            <p class="text-muted">{{$person->city}}</p>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <strong>Etnia</strong>
                                            <br>
                                            <p class="text-muted">{{$person->etnia}}</p>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <strong>Sexo</strong>
                                            <br>
                                            <p class="text-muted">{{$person->sex}}</p>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <strong>Roles</strong>
                                            <br>
                                            @foreach ($roles as $role)
                                                <span class="badge badge-success badge-shadow m-1">{{ $role->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                    <form action="{{ url('user/'.$user->id) }}" method="post" class="needs-validation">
                                        <div class="card-header">
                                            @csrf
                                            @method('PUT')
                                            <h4>Editar Perfil</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label class="form-control-label">Nombres Completos</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user-tie"></i></span>
                                                        </div>
                                                        <input type="text" name="name" placeholder="Nombres Completos"
                                                            class="form-control"
                                                            value="{{ old('name', $person->name) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label class="form-control-label">Apellidos Completos</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user-tie"></i></span>
                                                        </div>
                                                        <input type="text" name="lastname" class="form-control"
                                                            value="{{ old('lastname', $person->lastname) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-5 col-12">
                                                    <label class="form-control-label">Email</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-at"></i></span>
                                                        </div>
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ old('email', $user->email) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-7 col-12">
                                                    <label class="form-control-label">Contraseña</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-key"></i></span>
                                                        </div>
                                                        <input type="text" placeholder="Ingrese una contraseña sólo si desea modificarla."
                                                         name="password" class="form-control"
                                                            value="">
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label class="form-control-label">Teléfono</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-phone"></i></span>
                                                        </div>
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ old('phone', $person->phone) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label class="form-control-label">Fecha de Nacimiento</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-birthday-cake"></i></span>
                                                        </div>
                                                        <input class="form-control datepicker"
                                                            placeholder="Seleccionar fecha" id="date_birth"
                                                            name="date_birth" type="text" data-date-format="yyyy-mm-dd"
                                                            value="{{ old('date_birth', $person->date_birth) }}"
                                                            required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-7 col-12">
                                                    <label class="form-control-label">Dirección</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-map-marker-alt"></i></span>
                                                        </div>
                                                        <input type="text" name="address" class="form-control"
                                                            value="{{ old('address', $person->address) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5 col-12">
                                                    <label class="form-control-label">Ciudad</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-city"></i></span>
                                                        </div>
                                                        <input type="text" name="city" class="form-control"
                                                            value="{{ old('city', $person->city) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-success">Guardar</button>
                                        </div>
                                    </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(() => {
        $('#date_birth').datepicker('val');
    });
</script>

@vite([
'resources/js/app.js',
'resources/assets/js/scripts.js',
])

@if(session('warning'))
  <script>

    iziToast.error({
        title: 'Error!',
        message: '{{ session('warning') }}',
        position: 'topCenter'
      });

  </script>
@endif

@if(session('success'))
    <script>
    
      iziToast.success({
        title: 'Exito!',
        message: '{{ session('success') }}',
        position: 'topCenter'
      });

    </script>
@endif
@endsection