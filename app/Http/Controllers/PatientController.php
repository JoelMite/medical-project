<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class PatientController extends Controller
{
    //  Verificar que ha iniciado sesion
   public function __construct(){
        $this->middleware('auth');
    }

    //  Metodo GET Mostrar todos los Usuarios
    public function index(){

        // Gate::authorize('haveaccess','patient.index');

        //$patients =  User::with('rols')->paginate(5);
        $patients = User::whereHas('roles', function($query){ //  Me devuelve solo usuarios asociados al rol administrador y medico
        $query->where('name', 'Paciente')->where('creator_id','=',auth()->id());
        })->get();
        
        return view('patients.index', compact('patients'));
        //return redirect(dd($patients));
    }


    //  Metodo GET Abrir Formulario para Crear Nuevos Usuarios (Esencialmente Medicos y Administradores)
    public function create(){

        // Gate::authorize('haveaccess','patient.create');

        return view('patients.create');
    }


    //  Metodo Validacion
        private function validation(Request $request){
            //  Validar a los datos del formulario doctor a nivel de servidor
            $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'dni' => 'bail|required|ecuador:personal_identification|digits:10',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phone' => 'required|max:15',
            'address' => 'required',
            'city' => 'required',
            'etnia' => 'required',
            'date_birth' => 'required|date',
            // 'age' => 'required',
            'sex' => 'required'

            ];
            $messages = [
            'name.required' => 'Es necesario ingresar los nombres.',
            'lastname.required' => 'Es necesario ingresar los apellidos.',
            'dni.required' => 'Es necesario ingresar un DNI.',
            'dni.ecuador' => 'El DNI que ha ingresado es invalido.',
            'dni.digits' => 'El DNI que tiene que tener exactamente 10 dígitos.',
            'email.required' => 'Es necesario ingresar un correo.',
            'email.email' => 'Es necesario ingresar un correo válido.',
            'password.required' => 'Es necesario ingresar una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'phone.required' => 'Es necesario ingresar un teléfono.',
            'phone.max' => 'El número telefónico no puede exceder los 15 dígitos.',
            'address.required' => 'Es necesario ingresar una dirección.',
            'city.required' => 'Es necesario ingresar una ciudad.',
            'etnia.required' => 'Es necesario ingresar una etnia.',
            'date_birth.required' => 'Es necesario ingresar un a fecha de nacimiento.',
            'date_birth.date' => 'Es necesario ingresar una fecha de nacimiento válida.',
            'sex.required' => 'Es necesario ingresar un sexo.'
            ];
            $this->validate($request, $rules, $messages);
        }

    public function store(Request $request){
    $this->validation($request);

    //  Insertar Paciente
    // Nos aseguramos de capturar solamente la informacion que se espera del formulario
    $user = User::create(
        $request->only('email')
        + [
            'password'=>bcrypt($request->input('password')),
            'creator_id'=>auth()->id(),
            'state'=>'200'
        ]
    );

    $user->roles()->attach(3);

    $date_birth = Carbon::parse($request['date_birth'])->age; // Utilizo Carbon para calcular la edad a partir de la fecha de nacimiento

    $user->person()->create([
        'name' => $request['name'],
        'lastname' => $request['lastname'],
        'phone' => $request['phone'],
        'address' => $request['address'],
        'city' => $request['city'],
        'date_birth' => $request['date_birth'],
        'dni' => $request['dni'],
        'age' => $date_birth,
        'etnia' => $request['etnia'],
        'sex' => $request['sex'],
    ]);

    $success = "El paciente se ha registrado correctamente.";
    return redirect('/patients')->with(compact('success'));
    }

    /**
     * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(User $patient)
    {

    
    // Gate::authorize('haveaccessUser',[$patient, 'patient.index']);

        $roles = $patient->roles;                //  Me devuelve el rol que cumple cada usuario(medico o administrador)
        $persons = $patient->person;
        return view('patients.show', compact('patient', 'roles', 'persons'));
        //return dd($id);
    }

   
    public function edit(User $patient)
    {

    // Gate::authorize('haveaccessUser',[$patient, 'patient.edit']);

        // $patient = User::findOrfail($id);
        $time_now = Carbon::now(); // Tiempo Actual
        $time_update = Carbon::parse($patient->person['created_at'])->floatDiffInDays($time_now->toDateTimeString());
        // $persons = $patient->person;
        if ($time_update <= 0.25) { // Tiempo para actualizar maximo 6 horas
        return view('patients.edit', compact('patient'));
        //return dd($persons);
        }else{
        $warning = "▪ Los datos del paciente no se pueden actualizar porque se ha caducado el limite de tiempo.";
        return redirect('/patients')->with(compact('warning'));
        }
    }

   
    public function update(Request $request, User $patient)
    {
        //  Validar a los datos del formulario doctor a nivel de servidor
        $rules = [
        'name' => 'required',
        'lastname' => 'required',
        // 'dni' => 'bail|required|unique:persons,dni|ecuador:ci|digits:10',
        'dni' => 'bail|required|ecuador:ci|digits:10',
        // 'email' => 'required|unique:users,email|email',
        'email' => 'required|email',
        'password' => 'nullable|min:6',
        'phone' => 'required|max:15',
        'address' => 'required',
        'city' => 'required',
        'etnia' => 'required',
        'date_birth' => 'required|date',
        'sex' => 'required',

        ];
        $messages = [
        'name.required' => 'Es necesario ingresar los nombres.',
        'lastname.required' => 'Es necesario ingresar los apellidos.',
        'dni.required' => 'Es necesario ingresar un DNI.',
        // 'dni.unique' => 'Este DNI ya se encuentra registrado.',
        'dni.ecuador' => 'El DNI que ha ingresado es invalido.',
        'dni.digits' => 'El DNI que tiene que tener exactamente 10 dígitos.',
        'email.required' => 'Es necesario ingresar un correo.',
        // 'email.unique' => 'Este email ya se encuentra registrado.',
        'email.email' => 'Es necesario ingresar un correo válido.',
        'password.required' => 'Es necesario ingresar una contraseña.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        'phone.required' => 'Es necesario ingresar un telefono.',
        'phone.max' => 'El número telefónico no puede exceder los 15 dígitos.',
        'address.required' => 'Es necesario ingresar una direccion.',
        'city.required' => 'Es necesario ingresar una ciudad.',
        'etnia.required' => 'Es necesario ingresar una etnia.',
        'date_birth.required' => 'Es necesario ingresar una fecha de nacimiento.',
        'date_birth.date' => 'Es necesario ingresar una fecha de nacimiento válida.',
        'sex.required' => 'Es necesario ingresar un sexo.',
        ];
        $this->validate($request, $rules, $messages);

        $date_birth = Carbon::parse($request['date_birth'])->age;

        $patient->email = $request->input('email');
        $password = $request->input('password');

        if ($password)
        $patient->password = bcrypt($request->input('password'));

        $patient->save(); // Editar

        $person = $patient->person;

        $person->name = $request->name;
        $person->lastname = $request->lastname;
        $person->dni = $request->dni;
        $person->phone = $request->phone;
        $person->address = $request->address;
        $person->city = $request->city;
        $person->etnia = $request->etnia;
        $person->date_birth = $request->date_birth;
        $person->age = $date_birth;
        $person->sex = $request->sex;

        $person->save();

        $success = "El paciente se ha actualizado correctamente.";
        return redirect('/patients')->with(compact('success'));
    }


    public function state(User $patient)
    {

        // Gate::authorize('haveaccessUser',[$patient, 'user.state']);

        //dd($request->all());
        //$doctor = User::findOrfail($id);
        if($patient->state == "403"){
            $patient->state = "200";
            $success = "El usuario a sido activado";
        }
        elseif($patient->state == "200"){
            $patient->state = "403";
            $success = "El usuario a sido baneado";
        }
            if ($patient->save()){ // Editar
            return redirect('/patients')->with(compact('success'));
            // return dd($notification);
        }
    }

    public function count_patients(){

        // Gate::authorize('haveaccess','doctor.dashboard');

            $patients = User::whereHas('roles', function($query){ //  Me devuelve solo usuarios asociados al rol paciente.
            $query->where('name', 'Paciente')->where('creator_id','=',auth()->id());
            })->count();
            return response()->json($patients);
    }
}
