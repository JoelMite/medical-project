@extends('layouts.panel')

@section('content')

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Historias Clínicas</h4>
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
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($havePersonHistory as $person)
                  <tr>
                    <th scope="row">
                      {{ $person->name }}
                    </th>
                    <td>
                      {{ $person->lastname }}
                    </td>
                    <td>
                      <a href="{{ url('/histories/'.$person->history_clinic->id.'/edit') }}"
                        class="btn btn-sm btn-primary mr-2">Editar HC</a>
                      <a href="{{ url('/histories/'.$person->history_clinic->id) }}" class="btn btn-sm btn-warning">Ver
                        HC</a>
                    </td>
                  </tr>
                  @endforeach

                  @foreach ($nohavePersonHistory as $person)
                  <tr>
                    <th scope="row">
                      {{ $person->name }}
                    </th>
                    <td>
                      {{ $person->lastname }}
                    </td>
                    <td>
                      <a href="{{ url('histories/'.$person->user_id.'/create') }}" class="btn btn-sm btn-success">Crear
                        HC</a>
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