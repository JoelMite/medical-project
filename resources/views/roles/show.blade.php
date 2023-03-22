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
            <h4>Información del Rol</h4>
            <div class="card-header-action">
              <a href="{{url('roles')}}" class="btn btn-icon icon-left btn-warning"><i class="fas fa-reply"></i>
                Volver</a>
            </div>
          </div>
          <div class="card-body">
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <div class="form-group">
                    <label>Nombre del Rol</label>
                    <input type="text" name="name" class="form-control" value="{{ $role->name }}" disabled required>
                </div>
                </div>
                <div class="col-md-8 mb-3">
                  <div class="form-group">
                    <label>Descripción</label>
                    <input type="text" name="description" class="form-control" value="{{ $role->description }}" disabled required>
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
                        <label><strong>Gestionar Pacientes</strong></label>
                        @foreach ($permissions_patient as $key => $permission_patient)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" @if (in_array($permission_patient, $permissions_patient_name)) checked @endif id="{{'customCheck'.$key}}" disabled>
                            <label class="custom-control-label" for="{{'customCheck'.$key}}">{{ $permission_patient }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><strong>Gestionar Doctores</strong></label>
                        @foreach ($permissions_doctor as $key => $permission_doctor)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" @if (in_array($permission_doctor, $permissions_doctor_name)) checked @endif id="{{'customCheck'.$key}}" disabled>
                            <label class="custom-control-label" for="{{'customCheck'.$key}}">{{ $permission_doctor }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><strong>Gestionar Roles</strong></label>
                        @foreach ($permissions_role as $key => $permission_role)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" @if (in_array($permission_role, $permissions_role_name)) checked @endif id="{{'customCheck'.$key}}" disabled>
                            <label class="custom-control-label" for="{{'customCheck'.$key}}">{{ $permission_role }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><strong>Gestionar Especialidades</strong></label>
                        @foreach ($permissions_specialty as $key => $permission_specialty)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" @if (in_array($permission_specialty, $permissions_specialty_name)) checked @endif id="{{'customCheck'.$key}}" disabled>
                            <label class="custom-control-label" for="{{'customCheck'.$key}}">{{ $permission_specialty }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><strong>Gestionar Estado de Cuenta</strong></label>
                        @foreach ($permissions_user as $key => $permission_user)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" @if (in_array($permission_user, $permissions_user_name)) checked @endif id="{{'customCheck'.$key}}" disabled>
                            <label class="custom-control-label" for="{{'customCheck'.$key}}">{{ $permission_user }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><strong>Gestionar Historia Clinica</strong></label>
                        @foreach ($permissions_history_clinic as $key => $permission_history_clinic)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" @if (in_array($permission_history_clinic, $permissions_history_clinic_name)) checked @endif id="{{'customCheck'.$key}}" disabled>
                            <label class="custom-control-label" for="{{'customCheck'.$key}}">{{ $permission_history_clinic }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><strong>Gestionar Consultas y Citas Médicas</strong></label>
                        @foreach ($permissions_consultation_appointment_medical as $key => $permission_consultation_appointment_medical)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" @if (in_array($permission_consultation_appointment_medical, $permissions_consultation_appointment_medical_name)) checked @endif id="{{'customCheck'.$key}}" disabled>
                            <label class="custom-control-label" for="{{'customCheck'.$key}}">{{ $permission_consultation_appointment_medical }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-3 mb-2">
                        <label><strong>Gestionar Dashboard</strong></label>
                        @foreach ($permissions_dashboard as $key => $permission_dashboard)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" @if (in_array($permission_dashboard, $permissions_dashboard_name)) checked @endif id="{{'customCheck'.$key}}" disabled>
                            <label class="custom-control-label" for="{{'customCheck'.$key}}">{{ $permission_dashboard }}</label>
                        </div>
                        @endforeach
                    </div>
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