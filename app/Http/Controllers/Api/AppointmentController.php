<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalAppointment;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreAppointment;

class AppointmentController extends Controller
{

    /**
    * @OA\Get(
    *     path="/api/appointments",
    *     tags={"Appointments"},
    *     summary="Mostrar una lista de las citas medicas de un paciente",
    *     security={ {"bearer_token": {} }},
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todas las citas médicas asociadas al paciente. Estas pueden ser de estado reservado, confirmada o atendida.",
    *     @OA\MediaType(
    *           mediaType="application/json",
    *      )
    *     ),
    *   @OA\Response(
    *      response=401,
    *       description="Unauthenticated"
    *   ),
    *   @OA\Response(
    *      response=400,
    *      description="Bad Request"
    *   ),
    *   @OA\Response(
    *      response=404,
    *      description="not found"
    *   ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      )
    * )
    */

    public function index(){

      $user = Auth::guard('sanctum')->user();

        $appointments = $user->asPatientAppointments()->with(['specialty', 'doctor.person'])->get();
        return $appointments;
    }


    /**
     * @OA\Post(
     *  path="/api/appointments",
     *   tags={"Appointments"},
     *   summary="Registrar una nueva cita médica",
     *   operationId="store",
     *      security={
     *         {"bearer_token": {}}
     *     },
     *
     *   @OA\Parameter(
     *      name="description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="specialty_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="doctor_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="schedule_date",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="schedule_time",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          enum={"7:00 AM", "7:30 AM", "8:00 AM", "8:30 AM", "3:00 PM", "3:30 PM",
     *                "4:00 PM", "4:30 PM", "5:00 PM", "5:30 PM"},
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="type",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          enum={"Consulta Médica", "Revisión de Exámenes clínicos"},
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Registrar una nueva cita médica de acuerdo a los datos enviados por el paciente.",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function store(StoreAppointment $request){

      $patientId = Auth::guard('sanctum')->id();
      $appointment = MedicalAppointment::createForPatient($request, $patientId);

        if ($appointment) {
          $success = true;
        }else{
          $success = false;
        }

        return compact('success');
    }
}