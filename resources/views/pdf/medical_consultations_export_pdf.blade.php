<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Reporte Médico</title>

    <!-- Bootstrap core CSS -->

    <style>
        .text-right {
            text-align: right;
        }

        .invoice {
            background: white;
            border: 1px solid #CCC;
            font-size: 14px;
            padding: 48px;
            margin: 20px 0;
        }

        .tg-c3ow {
            border-color: inherit;
            text-align: center;
            vertical-align: top;
        }

        table {
            width: 100%;
        }

        td {
            padding: 5px 10px;
            border: 1px solid #999;
        }

        pre {
          font-size: 1rem;
          font-family: Open Sans;
        }
    </style>

</head>

<body class="login-page" style="background: white">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-lg-offset-1">
                <div class="row">
                    <div class="col">
                        <h4>Médico: Dr. {{ $data_doctor->person->name }}</h4>

                        <strong>Dirección: </strong>{{ $data_doctor->person->address }}. <br>
                        {{-- Toronto, Ontario - L2R 4U6<br> --}}
                        <strong>Teléfono: </strong>{{ $data_doctor->person->phone }} <br>
                        <strong>Email: </strong>{{ $data_doctor->email }} <br>


                    </div>

                    <div class="col">
                        <h4>Paciente: {{ $medical_consultations->clinic_history->person->lastname }} {{ $medical_consultations->clinic_history->person->name }}</h4>

                        <strong>Historia Clínica: </strong>{{ $medical_consultations->clinic_history_id }}<br>
                        <strong>C.I.: </strong>{{ $medical_consultations->clinic_history->person->dni }}<br>
                        <strong>Edad: </strong>{{ $medical_consultations->clinic_history->person->age }}<br>
                        <strong>Dirección: </strong>{{ $medical_consultations->clinic_history->person->address }}<br>
                        <strong>Email: </strong>{{ $medical_consultations->clinic_history->person->user->email }}

                    </div>

                </div>

                <div style="margin-bottom: 0px">&nbsp;</div>

                {{-- <hr style="height:4px;border-width:0;color:gray;background-color:#33DFFF"> --}}


                <div class="table-responsive">
                    <table class="table">
                        <thead style="background: #33DFFF;">
                            <tr>
                                <th>CONSULTA MÉDICA</th>
                                {{-- <th class="text-right">Price</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background: #F5F5F5;">
                                <td>
                                    <strong>Motivo</strong>
                                    <p> {{ $medical_consultations->reason }} </p>
                                </td>
                                {{-- <td class="text-right">$600</td> --}}
                            </tr>

                            <tr>
                                <td>
                                    <strong>Diagnóstico</strong>
                                    <p> {{ $medical_consultations->diagnosis }} </p>
                                </td>
                                {{-- <td class="text-right">$600</td> --}}
                            </tr>

                            <tr style="background: #F5F5F5;">
                                <td>
                                    <strong>Observaciones</strong>
                                    <p> {{ $medical_consultations->observations }} </p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div style="margin-bottom: 0px">&nbsp;</div>

                {{-- <hr style="height:4px;border-width:0;color:gray;background-color:#FFBE33"> --}}


                <table class="table">
                    <thead style="background: #FFBE33;">
                        <tr>
                            <th colspan="5">SIGNOS VITALES</th>
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
                            <td colspan="2" class="tg-c3ow"><span><strong>Temperatura</strong></span></td>
                        </tr>
                        <tr>
                            <td class="tg-c3ow">{{ $medical_consultations->imc }}</td>
                            <td class="tg-c3ow">{{ $medical_consultations->abdominal_perimeter }}</td>
                            <td class="tg-c3ow">{{ $medical_consultations->capillary_glucose }}</td>
                            <td colspan="2" class="tg-c3ow">{{ $medical_consultations->temperature }}</td>
                        </tr>

                    </tbody>
                </table>

                <div style="margin-bottom: 0px">&nbsp;</div>

                {{-- <hr style="height:4px;border-width:0;color:gray;background-color:#3FE902"> --}}

                <div class="table-responsive">
                    <table class="table ">
                        <thead style="background: #3FE902;">
                            <tr>
                                <th colspan="3">PRESCRIPCIÓN MÉDICA</th>
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
                                    <p> {{ $medical_prescription->description }} </p>
                                </td>
                                <td class="tg-c3ow">
                                    <p> {{ $medical_prescription->posology }} </p>
                                </td>
                                <td class="tg-c3ow">
                                    <p> {{ $medical_prescription->observations_pres }} </p>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div style="margin-bottom: 0px">&nbsp;</div>

                {{-- <hr style="height:4px;border-width:0;color:gray;background-color:#9A66FF"> --}}

                <div class="table-responsive">
                    <table class="table">
                        <thead style="background: #03F1E1;">
                            <tr>
                                <th colspan="4">PRUEBAS DE LABORATORIO</th>
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
                            <tr style="align:center">
                                <td class="tg-c3ow">
                                    <p> {{ $lab_test->type_of_exam }} </p>
                                </td>
                                <td class="tg-c3ow">
                                    <p> {{ $lab_test->quantity }} </p>
                                </td>
                                <td class="tg-c3ow">
                                    <p> {{ $lab_test->assessment }} </p>
                                </td>
                                <td class="tg-c3ow">
                                    <p> {{ $lab_test->observations_pru }} </p>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                  </div>

                    <div style="margin-bottom: 0px">&nbsp;</div>

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

</body>

</html>
