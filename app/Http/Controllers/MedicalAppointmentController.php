<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\MedicalAppointment;
use App\Models\Specialty;
use App\Models\Person;
use App\Models\User;
use Session;
use App\Http\Requests\StoreAppointment;
use Carbon\Carbon;
use App\Mail\ReservedAppointmentMail;
use App\Mail\AttendAppointmentMail;
use App\Mail\ConfirmedAppointmentMail;
use App\Mail\CanceledAppointmentMail;
use Illuminate\Support\Facades\Mail;

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
        Gate::authorize('haveaccess','appointmentmedicalDoctor.index');

        session(['url' => 'doctor']);
  
        return view('appointments.index');
    }

    public function indexPatient()
    {
        Gate::authorize('haveaccess','appointmentmedicalPatient.index');

        session(['url' => 'patient']);

        return view('appointments.index');

    }

    public function indexPendingAppointments()
    {

        if (session('url') == 'doctor') {

            Gate::authorize('haveaccess', 'appointmentmedicalDoctor.index');

            $value_one = 'doctor_id';
            $value_two = 'patient';

        } elseif (session('url') == 'patient') {

            Gate::authorize('haveaccess', 'appointmentmedicalPatient.index');

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

            Gate::authorize('haveaccess', 'appointmentmedicalDoctor.index');

            $value_one = 'doctor_id';
            $value_two = 'patient';

        } elseif (session('url') == 'patient') {

            Gate::authorize('haveaccess', 'appointmentmedicalPatient.index');

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

            Gate::authorize('haveaccess', 'appointmentmedicalDoctor.index');

            $value_one = 'doctor_id';
            $value_two = 'patient';

        } elseif (session('url') == 'patient') {

            Gate::authorize('haveaccess', 'appointmentmedicalPatient.index');

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
        Gate::authorize('haveaccess','appointmentmedical.create');

        if(session('patient_id')){
            Session::put('user_id', session('patient_id'));
        }else{
            Session::forget('user_id');
        }
        //Session::reflash();
        
        
        //return dd(session('user_id'));
        return view('medical_appointments.create');
    }

    public function create_appointments_for_patients(User $user)
    {
        $user_id = $user->id;

        // session(['user_id' => "$user_id"]);

        Session::flash('patient_id', "$user_id");
        //Session::reflash();
        return redirect('/medical_appointments/create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointment $request)
    {
        //Session::reflash();
        //Session::keep('user_id');
        //return dd(session('user_id'));
        if(session('user_id')){
            $user_id = session('user_id');
            Session::forget('user_id');
        }else{
            $user_id = auth()->user()->id;
        }
        //return dd(session('user_id'));

        $user = User::find($user_id);

        $created = MedicalAppointment::createForPatient($request, $user);

        //return dd($created);

        if ($created) {

        $specialty_name = Specialty::where('id', '=', $created->specialty_id)->get(['name'])->first();
        $doctor_name = Person::where('user_id', '=', $created->doctor_id)->get(['name', 'lastname'])->first();
        //return dd($specialty_name, $doctor_name);

        Mail::to(auth()->user()->email)->send(New ReservedAppointmentMail($created, $specialty_name, $doctor_name));

            $success = "La cita se ha registrado correctamente.";
            return redirect('/medical_appointments/create')->with(compact('success'));
        } else {
            $warning = "Ocurrio un problema al registrar la cita médica";
            return redirect('/medical_appointments/create')->with(compact('warning'));
        }

    }

    public function showCancelForm(MedicalAppointment $appointment)
    {
        Gate::authorize('haveaccessCancelAppointment', [$appointment, 'appointmentmedical.showCancelForm']);

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
        Gate::authorize('haveaccessCancelAppointment', [$appointment, 'appointmentmedical.showCancelForm']);

        if ($request->has('justification')) {
            $appointment->cancellation_justification = $request->input('justification');
            $appointment->cancelled_by_id = auth()->id();
        }

        $appointment->status = 'Cancelada';
        $specialty_name = Specialty::findOrfail($appointment->specialty_id)->get('name')->first();
        $doctor_name = Person::where('user_id', '=', $appointment->doctor_id)->get(['name', 'lastname'])->first();
        $cancellation_justification = $appointment->cancellation_justification;
        $person_cancel_appointment = Person::where('user_id', '=', $appointment->cancelled_by_id)->get(['name', 'lastname'])->first();
        $saved = $appointment->save(); // update

        // Ojo: Corregir el envio del email a la persona correcta o sea al paciente.
        if ($saved){
            Mail::to(auth()->user()->email)->send(New CanceledAppointmentMail($appointment, $specialty_name, $doctor_name, $cancellation_justification, $person_cancel_appointment));
        }

        if (session('url') == 'doctor') {

            return redirect('/appointment_medicals_doctor');

        }elseif(session('url') == 'patient'){
            
            return redirect('/appointment_medicals_patient');

        }
    }

    public function postConfirm(MedicalAppointment $appointment)
    {
        Gate::authorize('haveaccessConfirmAppointment', [$appointment, 'appointmentmedical.postConfirm']);

        $appointment->status = 'Confirmada';
        $specialty_name = Specialty::findOrfail($appointment->specialty_id)->get('name')->first();
        $doctor_name = Person::where('user_id', '=', $appointment->doctor_id)->get(['name', 'lastname'])->first();
        $saved = $appointment->save(); // update
        
        // Ojo: Corregir el envio del email a la persona correcta o sea al paciente.
        if ($saved){
            Mail::to(auth()->user()->email)->send(New ConfirmedAppointmentMail($appointment, $specialty_name, $doctor_name));
        }
    }

    public function postAttend(MedicalAppointment $appointment)
    {
        Gate::authorize('haveaccessConfirmAppointment', [$appointment, 'appointmentmedical.postConfirm']);
        // TODO Verificar si es necesario colocar una politica para marcar una cita como atendida.
        
        $appointment->status = 'Atendida';
        $specialty_name = Specialty::findOrfail($appointment->specialty_id)->get('name')->first();
        $doctor_name = Person::where('user_id', '=', $appointment->doctor_id)->get(['name', 'lastname'])->first();
        $saved = $appointment->save(); // update
        
        // Ojo: Corregir el envio del email a la persona correcta o sea al paciente.
        if ($saved) {
            Mail::to(auth()->user()->email)->send(New AttendAppointmentMail($appointment, $specialty_name, $doctor_name));
        }

    }

    public function pendingAppointments(Request $request)
    {

        if ($request->ajax() && $request->role == 'patient') {

            Gate::authorize('haveaccess', 'patient.dashboard');

            $pendingAppointments = MedicalAppointment::where('status', 'Reservada')
                ->where('patient_id', auth()->id())->count();
            return response()->json($pendingAppointments);

        }elseif($request->ajax() && $request->role == 'doctor'){

            Gate::authorize('haveaccess', 'doctor.dashboard');

            $pendingAppointments = MedicalAppointment::where('status', 'Reservada')
                ->where('doctor_id', auth()->id())->count();
            return response()->json($pendingAppointments);

        }
    }

    public function confirmedAppointments(Request $request)
    {

        if ($request->ajax() && $request->role == 'patient') {

            Gate::authorize('haveaccess', 'patient.dashboard');

            $confirmedAppointments = MedicalAppointment::where('status', 'Confirmada')
                ->where('patient_id', auth()->id())->count();
            return response()->json($confirmedAppointments);

        }elseif($request->ajax() && $request->role == 'doctor'){

            Gate::authorize('haveaccess', 'doctor.dashboard');

            $confirmedAppointments = MedicalAppointment::where('status', 'Confirmada')
                ->where('doctor_id', auth()->id())->count();
            return response()->json($confirmedAppointments);

        }
    }

    public function attendedAppointments(Request $request)
    {

        if ($request->ajax() && $request->role == 'patient') {

            Gate::authorize('haveaccess', 'patient.dashboard');

            $attendedAppointments = MedicalAppointment::where('status', 'Atendida')
                ->where('patient_id', auth()->id())->count();
            return response()->json($attendedAppointments);

        }elseif($request->ajax() && $request->role == 'doctor'){

            Gate::authorize('haveaccess', 'doctor.dashboard');

            $attendedAppointments = MedicalAppointment::where('status', 'Atendida')
                ->where('doctor_id', auth()->id())->count();
            return response()->json($attendedAppointments);

        }

    }
}
