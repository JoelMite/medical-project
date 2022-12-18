@extends('layouts.panel')

@section('content')

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Usuarios</h4>
            <div class="card-header-action">
              <a href="{{url('doctors/create')}}" class="btn btn-icon icon-left btn-dark"><i class="far fa-file"></i> Nuevo</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center">Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Especialidad</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($doctores as $doctor)
                  <tr>
                    <th scope="row">
                      {{ $doctor->person['name'] }}
                    </th>
                    <td>
                      {{ $doctor->person['lastname'] }}
                    </td>
                    <td>
                      {{ $doctor->person['phone'] }}
                    </td>
                    <td>
                      @foreach ($doctor->roles as $role)
                      <span class="badge badge-success badge-shadow m-1">{{ $role->name }}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($doctor->specialties as $specialty)
                      <span class="badge badge-info badge-shadow m-1">{{ $specialty->name }}</span>
                      @endforeach
                    </td>
                    <td>
                      <a href="{{ url('/doctors/'.$doctor->id.'/edit') }}" class="btn btn-sm btn-primary m-1">Editar</a>
                      <a href="{{ url('/doctors/'.$doctor->id) }}" class="btn btn-sm btn-warning m-1">Ver</a>
                      @if($doctor->state == '403')
                      <a href="{{ url('/doctors/'.$doctor->id.'/state') }}" class="btn btn-sm btn-success m-1">Activar</a>
                      @elseif($doctor->state == '200')
                      <a href="{{ url('/doctors/'.$doctor->id.'/state') }}" class="btn btn-sm btn-danger m-1">Banear</a>
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

<script src="{{ asset('/js/datatable/table.js') }}"></script>

@vite([
'resources/js/app.js',
'resources/assets/js/scripts.js',
])

@endsection