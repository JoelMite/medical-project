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
                        <h4>Nuevo Usuario</h4>
                        <div class="card-header-action">
                            <a href="{{url('doctors')}}" class="btn btn-icon icon-left btn-warning"><i
                                    class="fas fa-reply"></i>
                                Volver</a>
                        </div>
                    </div>
                    <form action="{{ url('doctors/'.$doctor->id) }}" method="post">
                        <div class="card-body">
                            @csrf
                            @method('PUT')

                            <div class="accordion" id="acordeon-01">
                                <!-- Primer elemento hijo-->
                                <div class="form-group">
                                    <div class="form-group" id="boton-collapse-1">
                                        <button class="btn btn-info btn-lg btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#contenido-btn-1" aria-expanded="true"
                                            aria-controls="contenido-btn-1">Datos Personales
                                            <i class="ni ni-check-bold text-white"></i></button>
                                    </div>
                                    <!-- Contenedor -->
                                    <div class="collapse show" id="contenido-btn-1" aria-labelledby="boton-collapse-1"
                                        data-parent="#acordeon-01">
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">Nombres</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user-tie"></i></span>
                                                        </div>
                                                        <input type="text" name="name" placeholder="Nombres Completos"
                                                            class="form-control"
                                                            value="{{ old('name', $persons->name) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">Apellidos</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user-tie"></i></span>
                                                        </div>
                                                        <input type="text" name="lastname" class="form-control"
                                                            value="{{ old('lastname', $persons->lastname) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">DNI</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="far fa-address-card"></i></span>
                                                        </div>
                                                        <input type="text" name="dni" class="form-control"
                                                            value="{{ old('dni', $persons->dni)  }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Segundo elemento hijo-->
                                <div class="form-group">
                                    <div class="form-group" id="boton-collapse-2">
                                        <button class="btn btn-warning btn-lg btn-block text-left collapsed"
                                            type="button" data-toggle="collapse" data-target="#contenido-btn-2"
                                            aria-expanded="false" aria-controls="contenido-btn-2">Datos de Usuario
                                            <i class="ni ni-check-bold text-white"></i></button>
                                    </div>
                                    <!-- Contenedor -->
                                    <div class="collapse" id="contenido-btn-2" aria-labelledby="boton-collapse-2"
                                        data-parent="#acordeon-01">
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">Email</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-at"></i></span>
                                                        </div>
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ old('email', $doctor->email) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">Contraseña</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-key"></i></span>
                                                        </div>
                                                        <input type="text" name="password" class="form-control"
                                                            value="">
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                    <p>- Ingrese una contraseña sólo si desea modificarla.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">Especialidad</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-clipboard-list"></i></span>
                                                        </div>
                                                        <select class="form-control selectpicker" name="specialties[]"
                                                            id="specialties" data-style="btn-warning text-white"
                                                            multiple title="Seleccione una o varias especialidades"
                                                            required>
                                                            @foreach ($specialties as $specialty)
                                                            <option value="{{ $specialty->id }}">{{ $specialty->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tercer elemento hijo-->
                                <div class="form-group">
                                    <div class="form-group" id="boton-collapse-3">
                                        <button class="btn btn-primary btn-lg btn-block text-left collapsed"
                                            type="button" data-toggle="collapse" data-target="#contenido-btn-3"
                                            aria-expanded="false" aria-controls="contenido-btn-3">Datos Adicionales
                                            <i class="ni ni-check-bold text-white"></i></button>
                                    </div>
                                    <!-- Contenedor -->
                                    <div class="collapse" id="contenido-btn-3" aria-labelledby="boton-collapse-3"
                                        data-parent="#acordeon-01">
                                        <div class="form-row">
                                            <div class="col-md-3 mb-2">
                                                <div class="form-group">
                                                    <label class="form-control-label">Teléfono</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-phone"></i></span>
                                                        </div>
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ old('phone', $persons->phone) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label class="form-control-label">Dirección</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-map-marker-alt"></i></span>
                                                        </div>
                                                        <input type="text" name="address" class="form-control"
                                                            value="{{ old('address', $persons->address) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <div class="form-group">
                                                    <label class="form-control-label">Ciudad</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-city"></i></span>
                                                        </div>
                                                        <input type="text" name="city" class="form-control"
                                                            value="{{ old('city', $persons->city) }}" required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="age">Edad</label>
                                                <input type="text" name="age" class="form-control"
                                                    value="{{ old('age', $persons->age) }}" required>
                                            </div> --}}
                                            <div class="col-md-3 mb-2">
                                                <div class="form-group">
                                                    <label class="form-control-label">Etnia</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-id-card-alt"></i></span>
                                                        </div>
                                                        <select class="form-control selectpicker" name="etnia"
                                                            id="etnia" data-style="btn-primary text-white"
                                                            title="Seleccione una etnia" required>
                                                            <option value="Mestizo">Mestizo</option>
                                                            <option value="Afroamericano">Afroamericano</option>
                                                            <option value="Indigena">Indigena</option>
                                                        </select>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label class="form-control-label">Fecha de Nacimiento</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-birthday-cake"></i></span>
                                                        </div>
                                                        <input class="form-control datepicker"
                                                            placeholder="Seleccionar fecha" id="date_birth"
                                                            name="date_birth" type="text" data-date-format="yyyy-mm-dd"
                                                            value="{{ old('date_birth', $persons->date_birth) }}"
                                                            required>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label class="form-control-label">Sexo</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-restroom"></i></span>
                                                        </div>
                                                        <select class="form-control selectpicker" name="sex" id="sex"
                                                            data-style="btn-primary text-white"
                                                            title="Seleccione un género" required>
                                                            <option value="Masculino">Masculino</option>
                                                            <option value="Femenino">Femenino</option>
                                                        </select>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="datebirth">Fecha de Nacimento</label>
                                                <input type="date" name="datebirth" class="form-control"
                                                    value="{{ old('datebirth', $persons->datebirth) }}" required>
                                            </div> --}}
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label class="form-control-label">Roles</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user-tag"></i></span>
                                                        </div>
                                                        <select class="form-control selectpicker" name="roles[]"
                                                            id="roles" data-style="btn-primary text-white" multiple
                                                            title="Seleccione uno o varios roles" required>
                                                            @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">
                                Guardar
                            </button>
                        </div>

                    </form>



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
{{-- <script src="{{ asset('/js/doctor/create.js') }}"></script> --}}

<script>
    $(document).ready(() => {
        $('#specialties').selectpicker('val', @json($specialty_ids));
        $('#etnia').selectpicker('val', @json($persons->etnia));
        // $('#date_birth').datepicker('val');
        $('#sex').selectpicker('val', @json($persons->sex));
        // $('#roles').selectpicker('val', [3]);
        $('#roles').selectpicker('val', @json($role_ids));
        $('#date_birth').datepicker('val');
    });
</script>

@vite([
'resources/js/app.js',
'resources/assets/js/scripts.js',
])
@endsection