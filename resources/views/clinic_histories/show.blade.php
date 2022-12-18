@extends('layouts.panel')

@section('content')


<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header m-t-20">
            <h3>Historia Clínica</h3>
          </div>
            
            <div class="card-body">
              <div class="alert alert-danger"><b>Antecedentes Personales</b></div>
                
                  @if($history != null)
                  
                      <p class="m-t-30">{{ $history->personal_history ? $history->personal_history:'No hay datos' }}</p>
                    
                  @endif
                
                  <div class="alert alert-success"><b>Antecedentes Familiares</b></div>


                  @if($history != null)
                  
                      <p class="m-t-30">{{ $history->family_background ? $history->family_background:'No hay datos' }}</p>
                    
                  @endif

                <div class="alert alert-info"><b>Enfermedad Actual</b></div>

                  @if($history != null)
                    
                    <p class="m-t-30">{{ $history->current_illness ? $history->current_illness:'No hay datos' }}</p>
                
                  @endif

                  <div class="alert alert-warning"><b>Hábitos</b></div>

                  @if($history != null)
                    
                    <p class="m-t-30">{{ $history->habits ? $history->habits:'No hay datos' }}</p>
                
                  @endif


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