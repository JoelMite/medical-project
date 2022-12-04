@extends('layouts.panel')

@section('content')

    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Nueva Cita</h3>
          </div>
          <div class="col text-right">
            <a href="{{url('/home')}}" class="btn btn-warning">
              Volver
            </a>
          </div>
        </div>
        </div>
        <div class="card-body">
          {{-- @if ($errors->any())
            <div class="alert alert-danger" role="alert">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif --}}
          <form action="{{url('appointment_medicals')}}" method="post">
            @csrf

            <div class="form-group">
              <label class="form-control-label">Descripción</label>
              <input name="description" id="description" type="text" class="form-control" value="{{ old('description')}}" placeholder="Describe brevemente tu cita con el medico." required>
            </div>

            {{-- <create-medical-appointment-component></create-medical-appointment-component> --}}

            {{-- <picker></picker> --}}

            <div class="form-group">
              <label class="form-control-label">Tipo de Consulta</label>
                <div class="custom-control custom-radio mb-3">
                  <input name="type" class="custom-control-input" id="type1" checked type="radio"
                  @if(old('type', 'Consulta médica') == 'Consulta médica') checked @endif value="Consulta médica">
                  <label class="custom-control-label" for="type1">Consulta médica</label>
                </div>
                <div class="custom-control custom-radio mb-3">
                  <input name="type"class="custom-control-input" id="type2" type="radio"
                  @if(old('type', 'Revisión de examenes clinicos') == 'Revisión de examenes clinicos') checked @endif value="Revisión de examenes clinicos">
                  <label class="custom-control-label" for="type2">Revisión de examenes clínicos</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">
              Guardar
            </button>
          </form>
      </div>
      </div>

@endsection

@section('scripts')

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
        message: ' {{ session('success') }} '
      },{
        type: 'success',
        animate: {
          enter: 'animated fadeInRight',
          exit: 'animated fadeOutRight'
        }
      });
    </script>
@endif
@endsection
