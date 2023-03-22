@extends('layouts.panel')

@section('content')

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Roles</h4>
            @can('haveaccess', 'role.create')
            <div class="card-header-action">
              <a href="{{url('roles/create')}}" class="btn btn-icon icon-left btn-dark"><i class="far fa-file"></i> Nuevo</a>
            </div>
            @endcan
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
                        @can('haveaccess', 'role.edit')
                        <a href="{{ url('/roles/'.$role->id.'/edit') }}" class="btn btn-primary m-1">Editar</a>
                        @endcan
                        @can('haveaccess', 'role.show')
                        <a href="{{ url('/roles/'.$role->id) }}" class="btn btn-warning m-1">Ver
                        </a>
                        @endcan
                     
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

@vite([
'resources/js/app.js',
'resources/assets/js/scripts.js',
])

@endsection