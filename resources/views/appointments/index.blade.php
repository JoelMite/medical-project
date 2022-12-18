@extends('layouts.panel')

@section('content')

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Mis Citas</h4>
          </div>
          <div class="card-body">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="myTab3" role="tablist">
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                  aria-controls="home" aria-selected="true">Citas Confirmadas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                  aria-controls="profile" aria-selected="false">Citas Pendientes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                  aria-controls="contact" aria-selected="false">Historial de Citas</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent2">
              <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                @include('appointments.confirmed-appointments')
              </div>
              <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                @include('appointments.pending-appointments')
              </div>
              <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                @include('appointments.old-appointments') 
              </div>
            </div>
          </div>
        </div>
      </div>


@endsection

@section('scripts')

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
