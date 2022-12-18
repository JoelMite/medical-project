<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MedicalConsultation;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      }
  
      public function show(MedicalConsultation $medical_consultations){

        //return dd($medical_consultations->clinic_history);
  
        $doctor_id = $medical_consultations->clinic_history->person->user->creator_id;
        $data_doctor = User::findOrfail($doctor_id);
        
        return view('pdf.medical_consultations_pdf', compact('medical_consultations', 'data_doctor'));
  
      }
      public function export(MedicalConsultation $medical_consultations){
  
        $doctor_id = $medical_consultations->clinic_history->person->user->creator_id;
        $data_doctor = User::findOrfail($doctor_id);
  
        $pdf = PDF::loadView('pdf.medical_consultations_export_pdf', compact('medical_consultations', 'data_doctor'));
        return $pdf->setPaper('a4', 'landscape')->stream('Reporte Médico');
  
      }
}
