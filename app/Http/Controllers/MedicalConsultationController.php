<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\ClinicHistory;
use App\Models\MedicalConsultation;

class MedicalConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $havePersonHistory = Person::has('clinic_history')->whereHas('user', function ($query) { //  Me devuelve solo usuarios asociados al rol administrador y medico
            $query->where('creator_id', '=', auth()->id())
                ->whereHas('roles', function ($query) {
                    $query->whereHas('permissions', function ($query) {
                        $query->where('name', '=', 'Crear Cita Médica');
                    });
                });
        })->get(['id', 'name', 'lastname', 'phone', 'address']);

        return view('medical_consultations.index', compact('havePersonHistory'));
    }

    public function index_show()
    {

      $histories = ClinicHistory::all();
      
      $variable = MedicalConsultation
      ::join("clinic_histories", "clinic_histories.id", "=", "medical_consultations.clinic_history_id")
      ->join("persons", "persons.id", "=", "clinic_histories.person_id")
      ->select("persons.id as id", "persons.name as name", "persons.lastname as lastname", "medical_consultations.created_at as created_at", "medical_consultations.id as medical_consultations_id")
      ->get();
      return view('medical_consultations.index_show', compact('variable'));
      
    }
}
