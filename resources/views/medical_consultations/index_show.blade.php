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
                                        <th>Fecha</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($variable as $person)
                                    <tr>
                                        <td>
                                            {{ $person->name }}
                                        </td>
                                        <td>
                                            {{ $person->lastname }}
                                        </td>
                                        <td>
                                            {{ $person->created_at ?? "No hay datos"}}
                                        </td>
                                        <td>
                                            <a href="{{ url('medical_consultations_pdf/'.$person->medical_consultations_id) }}"
                                                target="_blank" class="btn btn-sm btn-warning m-1">Ver Consulta Médica
                                                PDF</a>
                                            <a href="{{ url('medical_consultations_export_pdf/'.$person->medical_consultations_id) }}"
                                                target="_blank" class="btn btn-sm btn-success m-1">Exportar Consulta Médica
                                                PDF</a>
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