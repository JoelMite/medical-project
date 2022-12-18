<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte Médico</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    
    <style>

        .page-break {
            page-break-after: always;
        }
        .bg-grey {
            background: #F3F3F3;
        }
        .text-right {
            text-align: right;
        }
        .w-full {
            width: 100%;
        }
        .small-width {
            width: 15%;
        }
        .invoice {
            background: white;
            border: 1px solid #CCC;
            font-size: 14px;
            padding: 48px;
            margin: 20px 0;
        }
        .box-doctor{
          /* background-color:#d8ecf7; */
	        border:1px solid #afcde3;
          border-radius: 10px;
          -webkit-border-radius: 10px;
          padding: 15px;
          margin:0 0 25px;
        }
        .box-patient{
          /* background-color:#F8C471; */
	        border:1px solid #afcde3;
          border-radius: 10px;
          -webkit-border-radius: 10px;
          padding: 15px;
          margin:0 0 25px;
        }
        .tg-c3ow{
          border-color:inherit;
          text-align:center;
          vertical-align:top;
        }
        pre {
          font-size: 1rem;
          font-weight: 300;
          font-family: Open Sans;
          color: #525f7f;
        }
    </style>


@vite(['resources/assets/css/app.min.css',
'resources/assets/bundles/bootstrap-social/bootstrap-social.css',
'resources/assets/bundles/owlcarousel2/dist/assets/owl.carousel.min.css',
'resources/assets/bundles/owlcarousel2/dist/assets/owl.theme.default.min.css',
'resources/assets/bundles/summernote/summernote-bs4.css',
'resources/assets/css/custom.css', 
'resources/assets/css/style.css',
'resources/assets/css/components.css',

'resources/assets/bundles/datatables/datatables.min.css',
'resources/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',

// 'resources/assets/bundles/select2/dist/css/select2.min.css',

// 'resources/assets/bundles/jquery-selectric/selectric.css',

'resources/assets/bundles/pretty-checkbox/pretty-checkbox.min.css',

'resources/assets/bundles/izitoast/css/iziToast.min.css',

'resources/assets/bundles/bootstrap-daterangepicker/daterangepicker.css',

]) 

<link rel='shortcut icon' type='image/x-icon' href='/favicon-template.ico' />

</head>
<body class="bg-grey">

  <div class="container">
    <div class="row">
      {{-- <div class="col-lg-10 col-lg-offset-1" style="margin-top:20px; text-align: right">
        <div class="btn-group mb-4">
          <a href="/invoice-pdf" class="btn btn-success">Save as PDF</a>
        </div>
      </div> --}}
    </div>
    <div class="row">
      <div class="col-lg-12 col-lg-offset-1">
          <div class="invoice">
            <div class="row">
              <div class="col-sm" style="color:black;">
                <h4><strong>Médico: </strong>Dr. {{ $data_doctor->person->name }}</h4>
                <address>
                  <strong>Dirección: </strong>{{ $data_doctor->person->address }}. <br>
                  {{-- Toronto, Ontario - L2R 4U6<br> --}}
                  <strong>Teléfono: </strong>{{ $data_doctor->person->phone }} <br>
                  <strong>Email: </strong>{{ $data_doctor->email }} <br>
                </address>

              </div>

              <div class="col-sm" style="color:black;">
                <h4><strong>Paciente: </strong>{{ $medical_consultations->clinic_history->person->lastname }} {{ $medical_consultations->clinic_history->person->name }}</h4>
                <address>
                  <strong>Historia Clínica: </strong>{{ $medical_consultations->clinic_history_id }}<br>
                  <strong>C.I.: </strong>{{ $medical_consultations->clinic_history->person->dni }}<br>
                  <strong>Edad: </strong>{{ $medical_consultations->clinic_history->person->age }}<br>
                  <strong>Dirección: </strong>{{ $medical_consultations->clinic_history->person->address }}<br>
                  <strong>Email: </strong>{{ $medical_consultations->clinic_history->person->user->email }}
                </address>
              </div>

              {{-- <div class="col-sm-6 text-right">
                <img src="https://res.cloudinary.com/dqzxpn5db/image/upload/v1537151698/website/logo.png" alt="logo">
              </div> --}}
            </div>

           <hr style="height:4px;border-width:0;color:gray;background-color:#33DFFF">

            <div class="row">

              {{-- <div class="col-sm-5 text-right">
                <table class="w-full">
                  <tbody>
                    <tr>
                      <th>Invoice Num:</th>
                      <td>56</td>
                    </tr>
                    <tr>
                      <th> Invoice Date: </th>
                      <td>Jun 24, 2019</td>
                    </tr>
                  </tbody>
                </table>

                <div style="margin-bottom: 0px">&nbsp;</div>

                <table class="w-full">
                  <tbody>
                    <tr class="well" style="padding: 5px">
                      <th style="padding: 5px"><div> Balance Due (CAD) </div></th>
                      <td style="padding: 5px"><strong> $499 </strong></td>
                    </tr>
                  </tbody>
                </table>


              </div> --}}
            </div>

            <div class="table-responsive">
              <table class="table invoice-table">
                <thead style="background: #33DFFF;">
                  <tr>
                    <th>Consulta Médica</th>
                    {{-- <th class="text-right">Price</th> --}}
                  </tr>
                </thead>
                <tbody>
                  <tr style="background: #F5F5F5;">
                    <td>
                        <strong>Motivo</strong>
                        <pre> {{ $medical_consultations->reason }} </pre>
                    </td>
                    {{-- <td class="text-right">$600</td> --}}
                  </tr>

                  <tr>
                    <td>
                        <strong>Diagnóstico</strong>
                        <pre> {{ $medical_consultations->diagnosis }} </pre>
                    </td>
                    {{-- <td class="text-right">$600</td> --}}
                  </tr>

                  <tr style="background: #F5F5F5;">
                    <td>
                        <strong>Observaciones</strong>
                        <pre> {{ $medical_consultations->observations }} </pre>
                    </td>
                  </tr>

                  </tbody>
                </table>
              </div>

              <hr style="height:4px;border-width:0;color:gray;background-color:#FFBE33">

              <div class="table-responsive">
                <table class="table invoice-table">
                  <thead style="background: #FFBE33;">
                    <tr>
                      <th colspan="5">Signos Vitales</th>
                      {{-- <th class="text-right">Price</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    <tr style="background: #F5F5F5;">
                      <td class="tg-c3ow"><strong>Presión Arterial</strong></td>
                      <td class="tg-c3ow"><strong>Frecuencia Cardíaca</strong></td>
                      <td class="tg-c3ow"><strong>Frecuencia Respiratoria</strong></td>
                      <td class="tg-c3ow"><strong>Peso</strong></td>
                      <td class="tg-c3ow"><strong>Estatura</strong></td>
                    </tr>
                    <tr>
                      <td class="tg-c3ow">{{ $medical_consultations->blood_pressure }}</td>
                      <td class="tg-c3ow">{{ $medical_consultations->heart_rate }}</td>
                      <td class="tg-c3ow">{{ $medical_consultations->breathing_frequency }}</td>
                      <td class="tg-c3ow">{{ $medical_consultations->weight }}</td>
                      <td class="tg-c3ow">{{ $medical_consultations->height }}</td>
                    </tr>
                    <tr style="background: #F5F5F5;">
                      <td class="tg-c3ow"><span><strong>IMC</strong></span></strong></td>
                      <td class="tg-c3ow"><span><strong>Perímetro Abdominal</strong></span></strong></td>
                      <td class="tg-c3ow"><span><strong>Glucemia Capilar</strong></span></strong></td>
                      <td class="tg-c3ow" colspan="2"><span><strong>Temperatura</strong></span></td>
                    </tr>
                    <tr>
                      <td class="tg-c3ow">{{ $medical_consultations->imc }}</td>
                      <td class="tg-c3ow">{{ $medical_consultations->abdominal_perimeter }}</td>
                      <td class="tg-c3ow">{{ $medical_consultations->capillary_glucose }}</td>
                      <td class="tg-c3ow" colspan="2">{{ $medical_consultations->temperature }}</td>
                    </tr>

                    </tbody>
                </table>
              </div>

              <hr style="height:4px;border-width:0;color:gray;background-color:#3FE902">

              <div class="table-responsive">
                <table class="table invoice-table">
                  <thead style="background: #3FE902;">
                    <tr>
                      <th colspan="5">Prescripción Médica</th>
                      {{-- <th class="text-right">Price</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    <tr style="background: #F5F5F5;">
                      <td class="tg-c3ow"><strong>Descripción</strong></td>
                      <td class="tg-c3ow"><strong>Posología</strong></td>
                      <td class="tg-c3ow"><strong>Observaciones</strong></td>
                    </tr>

                    @foreach ( $medical_consultations->medical_prescriptions as $medical_prescription)
                      <tr>
                        <td class="tg-c3ow">
                            <pre> {{ $medical_prescription->description }} </pre>
                        </td>
                        <td class="tg-c3ow">
                            <pre> {{ $medical_prescription->posology }} </pre>
                        </td>
                        <td class="tg-c3ow">
                            <pre> {{ $medical_prescription->observations_pres }} </pre>
                        </td>
                      </tr>
                    @endforeach

                    </tbody>
                  </table>
                </div>

                <hr style="height:4px;border-width:0;color:gray;background-color:#9A66FF">

                  <div class="table-responsive">
                    <table class="table invoice-table">
                      <thead style="background: #9A66FF;">
                        <tr>
                          <th colspan="4" style="color: white">Pruebas de Laboratorio</th>
                          {{-- <th class="text-right">Price</th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        <tr style="background: #F5F5F5;">
                          <td class="tg-c3ow"><strong>Tipo de Exámen</strong></td>
                          <td class="tg-c3ow"><strong>Cantidad</strong></td>
                          <td class="tg-c3ow"><strong>Valoración</strong></td>
                          <td class="tg-c3ow"><strong>Observaciones</strong></td>
                        </tr>

                        @foreach ( $medical_consultations->lab_tests as $lab_test)
                          <tr>
                            <td class="tg-c3ow">
                                  <p> {{ $lab_test->type_of_exam }} </p>
                            </td>
                            <td class="tg-c3ow">
                                  <p> {{ $lab_test->quantity }} </p>
                            </td>
                            <td class="tg-c3ow">
                                  <pre> {{ $lab_test->assessment }} </pre>
                            </td>
                            <td class="tg-c3ow">
                                  <pre> {{ $lab_test->observations_pru }} </pre>
                            </td>
                          </tr>
                        @endforeach

                        </tbody>
                      </table>
                    </div>



              <!-- /table-responsive -->

              {{-- <table class="table invoice-total">
                <tbody>
                  <tr>
                    <td class="text-right"><strong>Balance Due :</strong></td>
                    <td class="text-right small-width">$600</td>
                  </tr>
                </tbody>
              </table> --}}

              <hr>

              {{-- <div class="row">
                <div class="col-lg-8">
                  <div class="invbody-terms">
                    Thank you for your business. <br>
                    <br>
                    <h4>Payment Terms and Methods</h4>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium cumque neque velit tenetur pariatur perspiciatis dignissimos corporis laborum doloribus, inventore.
                    </p>
                  </div>
                </div>
              </div> --}}
            </div>
        </div>
      </div>
    </div>

    <script src=" {{ asset('assets/js/app.min.js') }}"></script>
    <script src=" {{ asset('assets/bundles/izitoast/js/iziToast.min.js') }}"></script>
    <script src=" {{ asset('assets/js/page/toastr.js') }}"></script>
    <script src=" {{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src=" {{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script> 
    <script src=" {{ asset('assets/js/page/datatables.js') }}"></script>

    @vite([
        'resources/js/app.js',
        'resources/assets/js/scripts.js',
        ])

  </body>
</html>
