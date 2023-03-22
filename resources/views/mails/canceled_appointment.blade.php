<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cita reservada</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
      }
      .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      }
      h1 {
        color: #db1414;
        font-size: 28px;
        margin-top: 0;
      }
      ul {
        list-style: none;
        padding: 0;
        margin: 0;
      }
      li {
        margin-bottom: 10px;
      }
      p {
        margin-top: 0;
        margin-bottom: 20px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>Cita Cancelada</h1>
      <p>Su cita ha sido cancelada. Los detalles de su cita a continuación:</p>
      <ul>
        <strong><li>Fecha: {{ $appointment->schedule_date }} </li></strong>
        <strong><li>Hora: {{ $appointment->schedule_time }} </li></strong>
        <strong><li>Ubicación: Alonso de Mercadillo y Primera de Mayo (Consultorio Médico San Benito)</li></strong>        
        <strong><li>Médico: Dr. {{ $doctor_name->name }} {{ $doctor_name->lastname }}</li></strong>
        <strong><li>Especialidad: {{ $specialty_name->name }} </li></strong>
        @if($cancellation_justification)
            <strong><li>Motivo: {{ $cancellation_justification }} </li></strong>
            <strong><li>Persona que anulo la cita: Dr. {{ $person_cancel_appointment->name }} {{ $person_cancel_appointment->lastname }}</li></strong>
        @endif
      </ul>
      <p>Lamentamos los inconvenientes. Que tenga un excelente día</p>
    </div>
  </body>
</html>
