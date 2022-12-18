<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalAppointment;
use App\Http\Requests\StoreAppointment;
use Carbon\Carbon;

class MedicalAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexDoctor()
    {

        session(['url' => 'doctor']);
  
        return view('appointments.index');
    }

    public function indexPatient()
    {

        session(['url' => 'patient']);

        return view('appointments.index');

    }

    public function indexPendingAppointments()
    {


        if (session('url') == 'doctor') {

            $value_one = 'doctor_id';
            $value_two = 'patient';

        } elseif (session('url') == 'patient') {

            $value_one = 'patient_id';
            $value_two = 'doctor';

        }

        $pendingAppointments = MedicalAppointment::where('status', 'LIKE', '%Reservada%')
            ->where($value_one, auth()->id())
            ->with([$value_two => function ($query) {
                $query->select(['id'])->with(['person' => function ($query) {
                    $query->select(['user_id', 'id', 'name']);
                },
                ]);
            }
                , 'specialty:id,name'])->get();

        return response()->json($pendingAppointments);

    }

    public function indexConfirmedAppointments()
    {

        if (session('url') == 'doctor') {

            $value_one = 'doctor_id';
            $value_two = 'patient';

        } elseif (session('url') == 'patient') {

            $value_one = 'patient_id';
            $value_two = 'doctor';

        }

        $confirmedAppointments = MedicalAppointment::where('status', 'Confirmada')
            ->where($value_one, auth()->id())
            ->with([$value_two => function ($query) {
                $query->select(['id'])->with(['person' => function ($query) {
                    $query->select(['user_id', 'id', 'name']);
                },
                ]);
            }
                , 'specialty:id,name'])->get();

        return response()->json($confirmedAppointments);
    }

    public function indexOldAppointments()
    {

        if (session('url') == 'doctor') {

            $value_one = 'doctor_id';
            $value_two = 'patient';

        } elseif (session('url') == 'patient') {

            $value_one = 'patient_id';
            $value_two = 'doctor';

        }

        $oldAppointments = MedicalAppointment::whereIn('status', ['Atendida', 'Cancelada'])
            ->where($value_one, auth()->id())
            ->with([$value_two => function ($query) {
                $query->select(['id'])->with(['person' => function ($query) {
                    $query->select(['user_id', 'id', 'name']);
                },
                ]);
            }
            , 'cancelletion_by' => function ($query) {
                $query->select(['id'])->with(['person' => function ($query) {
                    $query->select(['user_id','id', 'name', 'lastname']);
                },
                ]);
             }
             , 'specialty:id,name'])->get();

        return response()->json($oldAppointments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medical_appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointment $request)
    {
        $created = MedicalAppointment::createForPatient($request, auth()->user()->id);

        if ($created) {
            $success = "La cita se ha registrado correctamente.";
        } else {
            $warning = "Ocurrio un problema al registrar la cita médica";
        }

        return redirect('/medical_appointments/create')->with(compact('success'));
    }

    public function showCancelForm(MedicalAppointment $appointment)
    {

        if ($appointment->status == 'Confirmada') {
            $role = session('url');
            if (!$role) {
                return redirect()->back();
            }
            $date_reservation = $appointment->schedule_date;
            $appointment_reservation = Carbon::parse($date_reservation)->locale('es')
            ->settings(['formatFunction' => 'isoFormat'])
            ->format('dddd, D [de] MMMM [del] YYYY');
            
            return view('appointments.cancel', compact('appointment', 'role', 'appointment_reservation'));
        }
        return redirect()->back();
    }

    public function postCancel(MedicalAppointment $appointment, Request $request)
    {
        
        if ($request->has('justification')) {
            $appointment->cancellation_justification = $request->input('justification');
            $appointment->cancelled_by_id = auth()->id();
        }

        $appointment->status = 'Cancelada';
        $saved = $appointment->save(); // update

        if (session('url') == 'doctor') {

            return redirect('/appointment_medicals_doctor');

        }elseif(session('url') == 'patient'){
            
            return redirect('/appointment_medicals_patient');

        }
    }

    public function postConfirm(MedicalAppointment $appointment)
    {

        $appointment->status = 'Confirmada';
        $saved = $appointment->save(); // update

    }

    public function postAttend(MedicalAppointment $appointment)
    {
        
        // TODO Verificar si es necesario colocar una politica para marcar una cita como atendida.

        $appointment->status = 'Atendida';
        $saved = $appointment->save(); // update

    }

    public function pendingAppointments(Request $request)
    {

        if ($request->ajax() && $request->role == 'patient') {

            $pendingAppointments = MedicalAppointment::where('status', 'Reservada')
                ->where('patient_id', auth()->id())->count();
            return response()->json($pendingAppointments);

        }elseif($request->ajax() && $request->role == 'doctor'){

            $pendingAppointments = MedicalAppointment::where('status', 'Reservada')
                ->where('doctor_id', auth()->id())->count();
            return response()->json($pendingAppointments);

        }
    }

    public function confirmedAppointments(Request $request)
    {

        if ($request->ajax() && $request->role == 'patient') {

            $confirmedAppointments = MedicalAppointment::where('status', 'Confirmada')
                ->where('patient_id', auth()->id())->count();
            return response()->json($confirmedAppointments);

        }elseif($request->ajax() && $request->role == 'doctor'){

            $confirmedAppointments = MedicalAppointment::where('status', 'Confirmada')
                ->where('doctor_id', auth()->id())->count();
            return response()->json($confirmedAppointments);

        }
    }

    public function attendedAppointments(Request $request)
    {

        if ($request->ajax() && $request->role == 'patient') {

            $attendedAppointments = MedicalAppointment::where('status', 'Atendida')
                ->where('patient_id', auth()->id())->count();
            return response()->json($attendedAppointments);

        }elseif($request->ajax() && $request->role == 'doctor'){

            $attendedAppointments = MedicalAppointment::where('status', 'Atendida')
                ->where('doctor_id', auth()->id())->count();
            return response()->json($attendedAppointments);

        }

    }
}
