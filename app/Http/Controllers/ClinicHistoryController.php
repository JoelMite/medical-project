<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Person;
use App\Models\User;
use App\Models\ClinicHistory;
use Session;

class ClinicHistoryController extends Controller
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

    public function index()
    {

      Gate::authorize('haveaccess','historyclinic.index');

      $havePersonHistory = Person::has('clinic_history')->whereHas('user', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
        $query->where('creator_id','=',auth()->id())
          ->whereHas('roles', function($query){
            $query->whereHas('permissions', function($query){
              $query->where('name','=','Crear Cita Médica');
            });
          });
        })->with('clinic_history:person_id,id')->get(['id', 'name', 'lastname']);
  
        $nohavePersonHistory = Person::doesntHave('clinic_history')->whereHas('user', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
          $query->where('creator_id','=',auth()->id())
            ->whereHas('roles', function($query){
              $query->whereHas('permissions', function($query){
                $query->where('name','=','Crear Cita Médica');
              });
            });
        })->get(['name', 'lastname', 'user_id']);
  
        return view('clinic_histories.index', compact('havePersonHistory', 'nohavePersonHistory'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
      Gate::authorize('haveaccesscreateHistoryClinic', [$user, 'historyclinic.create']);

      $person_id = $user->person->id;

      Session::flash('person_id', "$person_id");

      return view('clinic_histories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validation($request);

      $person_id = session('person_id');

      $history = ClinicHistory::create([

        'personal_history' => $request['personal_history'],
        'family_background' => $request['family_background'],
        'current_illness' => $request['current_illness'],
        'habits' => $request['habits'],
        'person_id' => $person_id
      ]);

      $success = "Se ha registrado correctamente la historia clínica.";
      return redirect('/clinic_histories')->with(compact('success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ClinicHistory $history)
    {
      Gate::authorize('haveaccessHistoryClinic',[$history, 'historyclinic.show']);

      return view('clinic_histories.show', compact('history')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ClinicHistory $histories)
    {
      Gate::authorize('haveaccessHistoryClinic',[$histories, 'historyclinic.edit']);

      return view('clinic_histories.edit', compact('histories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClinicHistory $histories)
    {
        $this->validation($request);
        $histories->personal_history = $request->input('personal_history');
        $histories->family_background = $request->input('family_background');
        $histories->current_illness = $request->input('current_illness');
        $histories->habits = $request->input('habits');
        $histories->save();

        $success = "La historia clínica se ha actualizado correctamente.";
        return redirect('/clinic_histories')->with(compact('success'));
    }

    //  Metodo Validacion
    private function validation(Request $request){
      //  Validar a los datos del formulario doctor a nivel de servidor

      // $history_id = session('history_id');

      $rules = [
        'personal_history' => 'required',
        'family_background' => 'required',
        'current_illness' => 'required',
        'habits' => 'required',
        //Rule::unique('history_clinics')->ignore($history_id),
        //unique:history_clinics,person_id
      ];
      $messages = [
        'personal_history.required' => 'Es necesario ingresar los antecedentes personales.',
        'family_background.required' => 'Es necesario ingresar los antecedentes familiares.',
        'current_illness.required' => 'Es necesario ingresar la enfermedad actual.',
        'habits.required' => 'Es necesario ingresar los hábitos actuales.',
        //'person_id.unique' => 'Este paciente ya tiene una historia clínica registrada.',
      ];
      $this->validate($request, $rules, $messages);
    }
}
