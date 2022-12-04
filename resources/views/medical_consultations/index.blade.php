@extends('layouts.panel')

@section('content')

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Consulta Médica</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center">
                      Nombres
                    </th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($havePersonHistory as $person)
                        <tr>
                        <td>
                            {{ $person->name }}
                        </td>
                        <td>
                            {{ $person->lastname }}
                        </td>
                        <td>
                            {{ $person->phone }}
                        </td>
                        <td>
                            {{ $person->address }}
                        </td>
                        <td>
                            <a href="{{ url('medical_consultations/'.$person->id.'/create') }}" class="btn btn-sm btn-success">Crear Consulta Médica</a>
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