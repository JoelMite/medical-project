@extends('layouts.panel')

@section('content')

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Roles</h4>
            <div class="card-header-action">
              <a href="{{url('roles/create')}}" class="btn btn-icon icon-left btn-dark"><i class="far fa-file"></i> Nuevo</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="datatable">
                <thead>
                  <tr>
                    <th scope="col" class="text-center">
                      Nombre
                    </th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roles as $role)
                  <tr>
                    <th scope="row">
                      {{ $role->name }}
                    </th>
                    <td>
                      {{ $role->description }}
                    </td>
                    <td>
                        <a href="{{ url('/roles/'.$role->id.'/edit') }}" class="btn btn-primary mr-2">Editar</a>
                        <a href="#" class="btn btn-warning">Ver</a>
                     
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