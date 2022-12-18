@extends('layouts.panel')

@section('content')

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Nueva Historia Clínica</h4>
                        <div class="card-header-action">
                            <a href="{{url('clinic_histories')}}" class="btn btn-icon icon-left btn-warning"><i
                                    class="fas fa-reply"></i> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{url('clinic_histories')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label class="form-control-label">Antecedentes Personales</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="
                                            fas fa-male"></i></span>
                                    </div>
                                    <textarea name="personal_history" class="form-control"
                                        value="{{ old('personal_history') }}" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Antecedentes Familiares</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="
                                            fas fa-users"></i></span>
                                    </div>
                                    <textarea name="family_background" class="form-control"
                                        value="{{ old('family_background') }}" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Enfermedad Actual</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-heartbeat"></i></span>
                                    </div>
                                    <textarea name="current_illness" class="form-control"
                                        value="{{ old('current_illness') }}" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Hábitos</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-paste"></i></span>
                                    </div>
                                    <textarea name="habits" class="form-control" value="{{ old('current_illness') }}"
                                        required></textarea>
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