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
            <h4>Editar Rol</h4>
            <div class="card-header-action">
              <a href="{{url('roles')}}" class="btn btn-icon icon-left btn-warning"><i class="fas fa-reply"></i>
                Volver</a>
            </div>
          </div>
          <form action="{{url('roles/'.$role->id)}}" method="post">
          <div class="card-body">
              @csrf
              @method('PUT')
              
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <div class="form-group">
                    <label>Nombre del Rol</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                </div>
                </div>
                <div class="col-md-8 mb-3">
                  <div class="form-group">
                    <label>Descripción</label>
                    <input type="text" name="description" class="form-control" value="{{ old('description', $role->description) }}" required>
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
                        <select class="form-control selectpicker" multiple data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions_patient_id" data-style="btn-primary"
                          title="Seleccione una o varios permisos">
                            @foreach ($permissions_patient as $permission_patient)
                            <option value="{{ $permission_patient->id }}">{{ $permission_patient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Gestionar Doctores</label>
                        <select class="form-control selectpicker" multiple data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions_doctor_id" data-style="btn-primary"
                          title="Seleccione una o varios permisos">
                            @foreach ($permissions_doctor as $permission_doctor)
                            <option value="{{ $permission_doctor->id }}">{{ $permission_doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Gestionar Roles</label>
                        <select class="form-control selectpicker" multiple data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions_role_id" data-style="btn-primary" title="Seleccione una o varios permisos">
                            @foreach ($permissions_role as $permission_role)
                            <option value="{{ $permission_role->id }}">{{ $permission_role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Gestionar Especialidades</label>
                        <select class="form-control selectpicker" multiple data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions_specialty_id" data-style="btn-primary"
                          title="Seleccione una o varios permisos">
                            @foreach ($permissions_specialty as $permission_specialty)
                            <option value="{{ $permission_specialty->id }}">{{ $permission_specialty->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Gestionar Estado de Cuenta</label>
                        <select class="form-control selectpicker" multiple data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions_user_id" data-style="btn-primary" title="Seleccione una o varios permisos">
                            @foreach ($permissions_user as $permission_user)
                            <option value="{{ $permission_user->id }}">{{ $permission_user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Gestionar Historia Clinica</label>
                        <select class="form-control selectpicker" multiple data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions_history_clinic_id" data-style="btn-primary"
                          title="Seleccione una o varios permisos">
                            @foreach ($permissions_history_clinic as $permission_history_clinic)
                            <option value="{{ $permission_history_clinic->id }}">{{ $permission_history_clinic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Gestionar Consultas y Citas Médicas</label>
                        <select class="form-control selectpicker" multiple data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions_consultation_appointment_medical_id" data-style="btn-primary"
                          title="Seleccione una o varios permisos">
                            @foreach ($permissions_consultation_appointment_medical as $permission_consultation_appointment_medical)
                            <option value="{{ $permission_consultation_appointment_medical->id }}">{{ $permission_consultation_appointment_medical->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Gestionar Dashboard</label>
                        <select class="form-control selectpicker" multiple data-selected-text-format="count" data-actions-box="true" name="permissions[]" id="permissions_dashboard_id" data-style="btn-primary"
                          title="Seleccione una o varios permisos">
                            @foreach ($permissions_dashboard as $permission_dashboard)
                            <option value="{{ $permission_dashboard->id }}">{{ $permission_dashboard->name }}</option>
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

<script>
    $(document).ready(() => {
        $('#permissions_patient_id').selectpicker('val',  @json($permissions_patient_id));
        $('#permissions_doctor_id').selectpicker('val',  @json($permissions_doctor_id));
        $('#permissions_role_id').selectpicker('val',  @json($permissions_role_id));
        $('#permissions_specialty_id').selectpicker('val',  @json($permissions_specialty_id));
        $('#permissions_user_id').selectpicker('val',  @json($permissions_user_id));
        $('#permissions_history_clinic_id').selectpicker('val',  @json($permissions_history_clinic_id));
        $('#permissions_consultation_appointment_medical_id').selectpicker('val',  @json($permissions_consultation_appointment_medical_id));
        $('#permissions_dashboard_id').selectpicker('val',  @json($permissions_dashboard_id));
    });
</script>

@vite([
'resources/js/app.js',
'resources/assets/js/scripts.js',
])
@endsection