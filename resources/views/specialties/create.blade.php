@extends('layouts.panel')

@section('content')

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Nueva Especialidad</h4>
                        <div class="card-header-action">
                            <a href="{{url('specialties')}}" class="btn btn-icon icon-left btn-warning"><i
                                    class="fas fa-reply"></i> Volver</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{url('specialties')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label>Nombre de la Especialidad</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <input type="text" class="form-control invoice-input">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-success">
                                Guardar
                            </button>
                        </form>
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