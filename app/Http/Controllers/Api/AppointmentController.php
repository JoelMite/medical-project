<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalAppointment;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreAppointment;

class AppointmentController extends Controller
{
    public function index(){

      // return 'good';

      $user = auth()->user();


        $appointments = $user->asPatientAppointments()->with(['specialty', 'doctor.person'])->get();

        return $appointments;
    }

    public function store(StoreAppointment $request){

      $patientId = Auth::guard('api')->id();
      // return compact('patientId');
      $appointment = MedicalAppointment::createForPatient($request, $patientId);

        if ($appointment) {
          $success = true;
        }else{
          $success = false;
        }

        return compact('success');
    }
}