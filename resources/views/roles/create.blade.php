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
            <h4>Nuevo Rol</h4>
            <div class="card-header-action">
              <a href="{{url('roles')}}" class="btn btn-icon icon-left btn-warning"><i class="fas fa-reply"></i>
                Volver</a>
            </div>
          </div>
          <form action="{{url('roles')}}" method="post">
          <div class="card-body">
              @csrf
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <div class="form-group">
                    <label>Nombre del Rol</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                  </div>
                </div>
                <div class="col-md-8 mb-3">
                  <div class="form-group">
                    <label>Descripción</label>
                    <input type="text" name="description" class="form-control" value="{{ old('description') }}" required>
                  </div>
                </div>
                <div class="col-md-12 mb-6">
                  <div class="form-group">
                    <label>
                      <h5>Permisos</h5>
                    </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 mb-3">
                      <label>Gestionar Pacientes</label>
                      <select class="form-control selectpicker" data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                        title="Seleccione una o varios permisos">
                          @foreach ($permissions_patient as $permission_patient)
                          <option value="{{ $permission_patient->id }}" {{ (collect(old('permissions'))->contains($permission_patient->id)) ? 'selected':'' }}>{{ $permission_patient->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-3 mb-3">
                      <label>Gestionar Doctores</label>
                      <select class="form-control selectpicker" data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                        title="Seleccione una o varios permisos">
                          @foreach ($permissions_doctor as $permission_doctor)
                          <option value="{{ $permission_doctor->id }}" {{ (collect(old('permissions'))->contains($permission_doctor->id)) ? 'selected':'' }}>{{ $permission_doctor->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-3 mb-3">
                      <label>Gestionar Roles</label>
                      <select class="form-control selectpicker" data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                        title="Seleccione una o varios permisos">
                          @foreach ($permissions_role as $permission_role)
                          <option value="{{ $permission_role->id }}" {{ (collect(old('permissions'))->contains($permission_role->id)) ? 'selected':'' }}>{{ $permission_role->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-3 mb-3">
                      <label>Gestionar Especialidades</label>
                      <select class="form-control selectpicker" data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                        title="Seleccione una o varios permisos">
                          @foreach ($permissions_specialty as $permission_specialty)
                          <option value="{{ $permission_specialty->id }}" {{ (collect(old('permissions'))->contains($permission_specialty->id)) ? 'selected':'' }}>{{ $permission_specialty->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-3 mb-3">
                      <label>Gestionar Estado de Cuenta</label>
                      <select class="form-control selectpicker" data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                        title="Seleccione una o varios permisos">
                          @foreach ($permissions_user as $permission_user)
                          <option value="{{ $permission_user->id }}" {{ (collect(old('permissions'))->contains($permission_user->id)) ? 'selected':'' }}>{{ $permission_user->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-3 mb-3">
                      <label>Gestionar Historia Clinica</label>
                      <select class="form-control selectpicker" data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                        title="Seleccione una o varios permisos">
                          @foreach ($permissions_history_clinic as $permission_history_clinic)
                          <option value="{{ $permission_history_clinic->id }}" {{ (collect(old('permissions'))->contains($permission_history_clinic->id)) ? 'selected':'' }}>{{ $permission_history_clinic->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-3 mb-3">
                      <label>Gestionar Consultas y Citas Médicas</label>
                      <select class="form-control selectpicker" data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                        title="Seleccione una o varios permisos">
                          @foreach ($permissions_consultation_appointment_medical as $permission_consultation_appointment_medical)
                          <option value="{{ $permission_consultation_appointment_medical->id }}" {{ (collect(old('permissions'))->contains($permission_consultation_appointment_medical->id)) ? 'selected':'' }}>{{ $permission_consultation_appointment_medical->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-3 mb-2">
                      <label>Gestionar Dashboard</label>
                      <select class="form-control selectpicker" data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions" data-style="btn-primary" multiple
                        title="Seleccione una o varios permisos">
                          @foreach ($permissions_dashboard as $permission_dashboard)
                          <option value="{{ $permission_dashboard->id }}" {{ (collect(old('permissions'))->contains($permission_dashboard->id)) ? 'selected':'' }}>{{ $permission_dashboard->name }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-lg btn-success">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

@if(session('warning'))
  <script>
  $.notify({
    title: '<strong>Error!</strong><br>',
    message: '{{ session('warning') }}'
  },{
    type: 'danger',
    animate: {
      enter: 'animated bounceInDown',
      exit: 'animated bounceOutUp'
    }
  });
  </script>
@endif

@if(session('success'))
    <script>
    $.notify({
      title: '<strong>Exito!</strong><br>',
      message: '{{ session('success') }}'
    },{
      type: 'success',
      animate: {
        enter: 'animated fadeInRight',
        exit: 'animated fadeOutRight'
      }
    });
    </script>
@endif

@vite([
'resources/js/app.js',
'resources/assets/js/scripts.js',
])
@endsection