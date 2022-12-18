@extends('layouts.panel')

@section('content')

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Cancelar Cita</h4>
                        <div class="card-header-action">
                            @if ($role == 'patient')
                            <a href="{{url('appointment_medicals_patient')}}" class="btn btn-danger">
                                Volver
                            </a>
                            @elseif($role == 'doctor')
                            <a href="{{url('appointment_medicals_doctor')}}" class="btn btn-danger">
                                Volver
                            </a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-6 mb-3">

                                <form action="{{ url('appointment_medicals/'.$appointment->id.'/cancel') }}"
                                    method="POST">
                                    @csrf

                                    <div class=" form-group">

                                        <label for="justification">Por favor cuéntanos el motivo de la cancelación de tu
                                            cita.</label>
                                        <textarea required name="justification" rows="8"
                                            class="form-control"></textarea>

                                    </div>

                                    <button type="submit" class="btn btn-success">Aceptar</button>

                                </form>

                            </div>


                            <div class="col-md-6 mb-3">
                                <div class=" form-group">
                                    <div class="card bg-danger text-white">
                                        <div class="card-body">
                                            <h3 class="card-title text-white"><i class="fas fa-exclamation"></i>&nbsp
                                                RECUERDA</h3>

                                            <blockquote blockquote class="blockquote text-white mb-0">
                                                @if ($role == 'patient')
                                                <p>Estas a punto de cancelar tu cita reservada con el
                                                    médico <b>{{ $appointment->doctor->person->name }}</b>
                                                    (especialidad <b>{{$appointment->specialty->name}}</b>)
                                                    para el día <b>{{ $appointment_reservation }}</b>
                                                    (hora <b>{{ $appointment->schedule_time_12 }}</b>)
                                                </p>
                                                @elseif ($role == 'doctor')

                                                <p>Estas a punto de cancelar tu cita reservada con el
                                                    paciente <b>{{ $appointment->patient->person->name }}</b>
                                                    (especialidad <b>{{$appointment->specialty->name}}</b>)
                                                    para el día <b>{{ $appointment_reservation }}</b>
                                                    (hora <b>{{ $appointment->schedule_time_12 }}</b>)
                                                </p>

                                                @endif
                                            </blockquote>
                                        </div>
                                    </div>
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

@vite([
'resources/js/app.js',
'resources/assets/js/scripts.js',
])

@endsection