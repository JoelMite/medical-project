@extends('layouts.panel')

@section('content')

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Nueva Cita Médica</h4>
            <div class="card-header-action">
              <a href="{{url('/home')}}" class="btn btn-icon icon-left btn-warning"><i class="fas fa-reply"></i>
                Volver</a>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('medical_appointments')}}" method="post">
              @csrf
              <div class="form-group">
                <label class="form-control-label">Descripción</label>
                <input name="description" id="description" type="text" class="form-control"
                  value="{{ old('description')}}" placeholder="Describe brevemente tu cita con el medico." required>
              </div>

              <create-medical-appointment-component></create-medical-appointment-component>

              <div class="form-group">
                <label class="form-control-label">Tipo de Consulta</label>
                <div class="custom-control custom-radio mb-3">
                  <input name="type" class="custom-control-input" id="type1" checked type="radio"
                    @if(old('type', 'Consulta médica' )=='Consulta médica' ) checked @endif value="Consulta médica">
                  <label class="custom-control-label" for="type1">Consulta médica</label>
                </div>
                <div class="custom-control custom-radio mb-3">
                  <input name="type" class="custom-control-input" id="type2" type="radio"
                    @if(old('type', 'Revisión de examenes clinicos' )=='Revisión de examenes clinicos' ) checked @endif
                    value="Revisión de examenes clinicos">
                  <label class="custom-control-label" for="type2">Revisión de examenes clínicos</label>
                </div>
              </div>

              <button type="submit" class="btn btn-lg btn-success">
                Guardar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')

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