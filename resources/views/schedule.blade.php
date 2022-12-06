@extends('layouts.panel')

@section('content')

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <form action="{{ url('/schedule') }}" method="post">
          @csrf
          <div class="card">
            <div class="card-header">
              <h4>Gestionar Horario</h4>
              <div class="card-header-action">
                <button type="submit" class="btn btn-icon icon-left btn-success"><i class="far fa-edit"></i>
                  Guardar
                  </a>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col" class="text-center">Dia</th>
                      <th scope="col" class="text-center">Activo</th>
                      <th scope="col" class="text-center">Turno Mañana</th>
                      <th scope="col" class="text-center">Turno Tarde</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{--@if(!$workDays->isEmpty())--}}
                    @foreach($workDays as $key => $workDay)
                    <tr>
                      <th class="text-center">{{ $days[$key] }}</th>
                      <td class="text-center">
                        <div class="pretty p-icon p-smooth">
                        <input type="checkbox" name="active[]" value="{{ $key }}" @if($workDay->active) checked
                          @endif/>
                          <div class="state p-success">
                            <i class="icon material-icons">done</i>
                            <label></label>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col">
                            {{-- input type="time" class="form-control"> --}}
                            <select class="form-control" data-style="btn-secondary" name="morning_start[]">
                              @for($i=5; $i<=11; $i++) <option value="{{ ($i < 10 ? '0' : ''). $i }}:00" @if($i.':00
                                AM'==$workDay->morning_start) selected @endif>{{ $i }}:00 AM</option>
                                <option value="{{ ($i < 10 ? '0' : ''). $i }}:30" @if($i.':30 AM'==$workDay->
                                  morning_start) selected @endif>{{ $i }}:30 AM</option>
                                @endfor
                            </select>
                          </div>
                          <div class="col">
                            {{-- input type="time" class="form-control"> --}}
                            <select class="form-control" data-style="btn-secondary" name="morning_end[]">
                              @for($i=5; $i<=11; $i++) <option value="{{ ($i < 10 ? '0' : ''). $i }}:00" @if($i.':00
                                AM'==$workDay->morning_end) selected @endif>{{ $i }}:00 AM</option>
                                <option value="{{ ($i < 10 ? '0' : ''). $i }}:30" @if($i.':30 AM'==$workDay->
                                  morning_end) selected @endif>{{ $i }}:30 AM</option>
                                @endfor
                            </select>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col">
                            <select class="form-control" data-style="btn-secondary" name="afternoon_start[]">
                              @for($i=1; $i<=11; $i++) <option value="{{ $i+12 }}:00" @if($i.':00 PM'==$workDay->
                                afternoon_start) selected @endif>{{ $i }}:00 PM</option>
                                <option value="{{ $i+12 }}:30" @if($i.':30 PM'==$workDay->afternoon_start) selected
                                  @endif>{{ $i }}:30 PM</option>
                                @endfor
                            </select>
                          </div>
                          <div class="col">
                            <select class="form-control" data-style="btn-secondary" name="afternoon_end[]">
                              @for($i=1; $i<=11; $i++) <option value="{{ $i+12 }}:00" @if($i.':00 PM'==$workDay->
                                afternoon_end) selected @endif>{{ $i }}:00 PM</option>
                                <option value="{{ $i+12 }}:30" @if($i.':30 PM'==$workDay->afternoon_end) selected
                                  @endif>{{ $i }}:30 PM</option>
                                @endfor
                            </select>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
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