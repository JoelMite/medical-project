@extends('layouts.panel')

@section('content')

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pacientes</h4>
                        <div class="card-header-action">
                            <a href="{{url('patients/create')}}" class="btn btn-icon icon-left btn-dark"><i
                                    class="far fa-file"></i> Nuevo</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="datatable">
                                <thead>

                                    <tr>
                                        <th class="text-center">Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Telefono</th>
                                        <th>Domicilio</th>
                                        <th>Ciudad</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $patient)

                                    <tr scope="row">

                                        <td>
                                            {{ $patient->person->name }}
                                        </td>
                                        <td>
                                            {{ $patient->person->lastname }}
                                        </td>
                                        <td>
                                            {{ $patient->person->phone }}
                                        </td>
                                        <td>
                                            {{ $patient->person->address }}
                                        </td>
                                        <td>
                                            {{ $patient->person->city }}
                                        </td>
                                        <td>
                                            <a href="{{ url('/patients/'.$patient->id.'/edit') }}"
                                                class="btn btn-sm btn-primary m-1">Editar</a>
                                            <a href="{{ url('/patients/'.$patient->id) }}"
                                                class="btn btn-sm btn-warning m-1">Ver</a>
                                            @if($patient->state == '403')
                                            <a href="{{ url('/patients/'.$patient->id.'/state') }}"
                                                class="btn btn-sm btn-success m-1">Activar</a>
                                            @elseif($patient->state == '200')
                                            <a href="{{ url('/patients/'.$patient->id.'/state') }}"
                                                class="btn btn-sm btn-danger m-1">Banear</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>
--}}

<script src="{{ asset('/js/datatable/table.js') }}"></script>

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