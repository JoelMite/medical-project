@extends('layouts.panel')

@section('dashboard')

{{-- @if(auth()->user()->rols()->first()->name == 'Administrador') --}}

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">


          {{-- @can('haveaccess','administrator.dashboard') --}}
          <div class="card-header">
            <h2>Administrador</h2>
          </div>
          <div class="card-body">
            <home-dashboard-administrator-component></home-dashboard-administrator-component>
          </div>
          {{-- @endcan --}}

          {{-- @can('haveaccess','patient.dashboard') --}}
          <div class="card-header">
            <h2>Médico</h2>
          </div>
          <div class="card-body">
            <home-dashboard-doctor-component></home-dashboard-doctor-component>
          </div>
          {{-- @endcan --}}

          {{-- @elseif(auth()->user()->rols()->first()->name == 'Medico') --}}

          <div class="card-header">
            <h2>Paciente</h2>
          </div>
          <div class="card-body">

            {{-- @can('haveaccess','doctor.dashboard') --}}

            <home-dashboard-patient-component></home-dashboard-patient-component>
          </div>
          {{-- @endcan --}}
          {{--
          <welcome /> --}}

        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')

@vite([
'resources/js/app.js',
'resources/assets/bundles/chartjs/chart.min.js',
'resources/assets/bundles/owlcarousel2/dist/owl.carousel.min.js',
//'resources/assets/bundles/summernote/summernote-bs4.js',
'resources/assets/js/page/widget-data.js',
'resources/assets/js/scripts.js',
])

@endsection